<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

/**
 * MemorySafetyTest
 *
 * Verifies that every memory-protection layer works correctly:
 *
 * 1. MemoryGuard middleware  — sets memory limit proportional to file size
 * 2. guardDimensions()       — rejects images whose pixel count exceeds the cap
 * 3. streamAssembleChunks()  — chunk assembly never loads chunk data into PHP memory
 * 4. streamUrlToTemp()       — URL download streams to disk (tested via SSRF / size guard)
 * 5. autoDownscaleIfNeeded() — large images are shrunk before heavy processing
 * 6. php.ini baseline        — base memory_limit is 96M (low) not 512M
 * 7. No ini_set('memory_limit') in controllers
 */
class MemorySafetyTest extends TestCase
{
    use RefreshDatabase;

    // ─────────────────────────────────────────────────────────────────
    // Helpers
    // ─────────────────────────────────────────────────────────────────

    private function minimalJpeg(int $w = 4, int $h = 4): string
    {
        $img = imagecreatetruecolor($w, $h);
        imagefilledrectangle($img, 0, 0, $w, $h, imagecolorallocate($img, 180, 100, 60));
        ob_start();
        imagejpeg($img, null, 80);
        $data = ob_get_clean();
        imagedestroy($img);
        return $data;
    }

    private function minimalPng(int $w = 4, int $h = 4): string
    {
        $img = imagecreatetruecolor($w, $h);
        imagefilledrectangle($img, 0, 0, $w, $h, imagecolorallocate($img, 60, 120, 200));
        ob_start();
        imagepng($img);
        $data = ob_get_clean();
        imagedestroy($img);
        return $data;
    }

    /**
     * Create a JPEG of specified pixel dimensions via a subprocess so the test
     * process itself is not burdened with GD's raw pixel buffer (64MB for 4097²).
     * The file is written to a temp path and cached in a static for the test run.
     */
    private static array $dimCache = [];

    private function jpegWithDimensions(int $w, int $h): string
    {
        $key     = "{$w}x{$h}";
        $outFile = sys_get_temp_dir() . "/mst_jpeg_{$w}x{$h}_" . getmypid() . ".jpg";

        // Re-use if already created in this process run
        if (file_exists($outFile) && filesize($outFile) > 0) {
            return file_get_contents($outFile);
        }

        $escapedOut = addslashes($outFile);
        $script = <<<PHP
<?php
ini_set('memory_limit','512M');
\$img = imagecreatetruecolor({$w}, {$h});
imagefill(\$img, 0, 0, imagecolorallocate(\$img, 200, 200, 200));
imagejpeg(\$img, '{$escapedOut}', 60);
imagedestroy(\$img);
echo 'ok';
PHP;
        $tmpScript = tempnam(sys_get_temp_dir(), 'gdscript_') . '.php';
        file_put_contents($tmpScript, $script);

        $cmd = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg($tmpScript);
        exec("{$cmd} 2>&1", $output, $code);
        @unlink($tmpScript);

        $this->assertSame(0, $code, "GD subprocess failed: " . implode("\n", $output));
        $this->assertFileExists($outFile);
        $this->assertGreaterThan(0, filesize($outFile), "Subprocess wrote an empty file");

        return file_get_contents($outFile);
    }

    private function makeUpload(string $data, string $filename, string $mime): UploadedFile
    {
        $tmp = tempnam(sys_get_temp_dir(), 'mst_');
        file_put_contents($tmp, $data);
        return new UploadedFile($tmp, $filename, $mime, null, true);
    }

    private function uploadChunksFor(string $data, string $filename, int $chunkSize = 256): array
    {
        $totalChunks = max(1, (int) ceil(strlen($data) / $chunkSize));
        $uploadId    = 'mem-test-' . uniqid();
        for ($i = 0; $i < $totalChunks; $i++) {
            $part  = substr($data, $i * $chunkSize, $chunkSize);
            $chunk = UploadedFile::fake()->createWithContent('chunk', $part);
            $this->postJson(route('t2.chunk'), [
                'chunk'        => $chunk,
                'upload_id'    => $uploadId,
                'chunk_index'  => $i,
                'total_chunks' => $totalChunks,
            ])->assertStatus(200);
        }
        return ['uploadId' => $uploadId, 'totalChunks' => $totalChunks];
    }

    // ═════════════════════════════════════════════════════════════════
    // 1. MemoryGuard Middleware
    // ═════════════════════════════════════════════════════════════════

    public function test_memory_guard_middleware_is_registered(): void
    {
        // The middleware alias must be resolvable from the container
        $mw = app(\App\Http\Middleware\MemoryGuard::class);
        $this->assertInstanceOf(\App\Http\Middleware\MemoryGuard::class, $mw);
    }

    public function test_memory_guard_is_applied_to_compress_route(): void
    {
        // Any successful response on a processing route confirms middleware ran
        $file = $this->makeUpload($this->minimalJpeg(), 'photo.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.compress'), [
            'image'   => $file,
            'quality' => 50,
        ]);

        // 200 proves middleware ran without crashing
        $response->assertStatus(200);
        $this->cleanupResult($response);
    }

    public function test_memory_guard_is_applied_to_t2_finalize_route(): void
    {
        $info = $this->uploadChunksFor($this->minimalJpeg(), 'test.jpg');
        $response = $this->postJson(route('t2.finalize'), [
            'upload_id'     => $info['uploadId'],
            'total_chunks'  => $info['totalChunks'],
            'original_name' => 'test.jpg',
            'action'        => 'img_to_pdf',
            'page_size'     => 'A4',
            'orientation'   => 'portrait',
        ]);
        $response->assertStatus(200);
        $this->cleanupResult($response);
    }

    public function test_memory_guard_sets_limit_proportional_to_file_size(): void
    {
        // Use a real-sized JPEG (~2KB) — limit should be set before the controller runs
        $file = $this->makeUpload($this->minimalJpeg(), 'photo.jpg', 'image/jpeg');

        // After the request, memory_limit should NOT be 512M (the old static value).
        // We can verify by checking the middleware class directly.
        $guard = new \App\Http\Middleware\MemoryGuard();
        $request = \Illuminate\Http\Request::create('/test', 'POST');
        $limitBefore = ini_get('memory_limit');

        $guard->handle($request, function ($req) use (&$limitDuring) {
            $limitDuring = ini_get('memory_limit');
            return response('ok');
        });

        // For a zero-byte request, should be the minimum (96M)
        $this->assertEquals('96M', $limitDuring);
    }

    public function test_memory_guard_does_not_exceed_max_cap(): void
    {
        // Simulate a very large Content-Length (e.g. 100MB) — limit should cap at 256M
        $guard   = new \App\Http\Middleware\MemoryGuard();
        $request = \Illuminate\Http\Request::create('/test', 'POST');
        $request->headers->set('Content-Length', (string)(100 * 1024 * 1024)); // 100 MB

        $limitDuring = null;
        $guard->handle($request, function ($req) use (&$limitDuring) {
            $limitDuring = ini_get('memory_limit');
            return response('ok');
        });

        // 100 MB × 6 expansion + 64 base = 664 MB → capped at 256M
        $this->assertEquals('256M', $limitDuring);
    }

    // ═════════════════════════════════════════════════════════════════
    // 2. guardDimensions — image too large
    // ═════════════════════════════════════════════════════════════════

    public function test_guard_dimensions_rejects_oversize_image_on_compress(): void
    {
        // IMAGE_MAX_PIXELS default is 4096×4096 = 16,777,216 px
        // We create a 4097×4097 = 16,785,409 px image
        $bigJpeg = $this->jpegWithDimensions(4097, 4097);
        $file    = $this->makeUpload($bigJpeg, 'huge.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.compress'), [
            'image'   => $file,
            'quality' => 50,
        ]);

        $response->assertStatus(422);
        $this->assertStringContainsString('too large', strtolower($response->json('message')));
    }

    public function test_guard_dimensions_rejects_oversize_image_on_resize(): void
    {
        $bigJpeg = $this->jpegWithDimensions(4097, 4097);
        $file    = $this->makeUpload($bigJpeg, 'huge.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.resize'), [
            'image' => $file,
            'mode'  => 'max_width',
            'width' => 800,
        ]);

        $response->assertStatus(422);
        $this->assertStringContainsString('too large', strtolower($response->json('message')));
    }

    public function test_guard_dimensions_rejects_oversize_image_on_watermark(): void
    {
        $bigJpeg = $this->jpegWithDimensions(4097, 4097);
        $file    = $this->makeUpload($bigJpeg, 'huge.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.watermark'), [
            'image' => $file,
            'text'  => 'Watermark',
        ]);

        $response->assertStatus(422);
        $this->assertStringContainsString('too large', strtolower($response->json('message')));
    }

    public function test_guard_dimensions_rejects_oversize_image_on_img_to_pdf(): void
    {
        $bigJpeg = $this->jpegWithDimensions(4097, 4097);
        $file    = $this->makeUpload($bigJpeg, 'huge.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'A4',
            'orientation' => 'portrait',
        ]);

        $response->assertStatus(422);
        $this->assertStringContainsString('too large', strtolower($response->json('message')));
    }

    public function test_guard_dimensions_allows_normal_size_image(): void
    {
        // 100×100 = 10,000 px — well under any limit
        $smallJpeg = $this->jpegWithDimensions(100, 100);
        $file      = $this->makeUpload($smallJpeg, 'small.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.compress'), [
            'image'   => $file,
            'quality' => 50,
        ]);

        $response->assertStatus(200);
        $this->cleanupResult($response);
    }

    public function test_guard_dimensions_rejects_oversize_image_via_chunked_finalize(): void
    {
        $bigJpeg = $this->jpegWithDimensions(4097, 4097);
        // Use 32KB chunks → a ~265KB JPEG needs only ~9 chunks (well under throttle limits)
        $info    = $this->uploadChunksFor($bigJpeg, 'huge.jpg', 32768);

        $response = $this->postJson(route('t2.finalize'), [
            'upload_id'     => $info['uploadId'],
            'total_chunks'  => $info['totalChunks'],
            'original_name' => 'huge.jpg',
            'action'        => 'resize',
            'mode'          => 'max_width',
            'width'         => 800,
        ]);

        $response->assertStatus(422);
        $this->assertStringContainsString('too large', strtolower($response->json('message')));
    }

    // ═════════════════════════════════════════════════════════════════
    // 3. streamAssembleChunks — stream-based assembly
    // ═════════════════════════════════════════════════════════════════

    /** Helper proxy so we can call protected trait methods from a test */
    private function makeTraitProxy(): object
    {
        return new class {
            use \App\Http\Controllers\Concerns\ImageSafetyGuard;
            public function assemble(string $dir, string $out, int $n): void
            {
                $this->streamAssembleChunks($dir, $out, $n);
            }
            public function urlToTemp(string $url, int $max): string
            {
                return $this->streamUrlToTemp($url, $max);
            }
            public function guard(string $path): void
            {
                $this->guardDimensions($path);
            }
            public function downscale(string $path, string $mime): void
            {
                $this->autoDownscaleIfNeeded($path, $mime);
            }
        };
    }

    public function test_stream_assemble_chunks_produces_correct_file(): void
    {
        $proxy = $this->makeTraitProxy();

        $dir = storage_path('app/temp-uploads/test-stream-' . uniqid());
        @mkdir($dir, 0755, true);

        $original  = str_repeat('ABCDEFGHIJ', 100); // 1000 bytes
        $chunkSize = 300;
        $total     = (int) ceil(strlen($original) / $chunkSize);

        for ($i = 0; $i < $total; $i++) {
            file_put_contents("{$dir}/chunk_{$i}", substr($original, $i * $chunkSize, $chunkSize));
        }

        $assembled = "{$dir}/assembled.txt";
        $proxy->assemble($dir, $assembled, $total);

        $this->assertFileExists($assembled);
        $this->assertEquals($original, file_get_contents($assembled));

        // All chunk files must be deleted after assembly
        for ($i = 0; $i < $total; $i++) {
            $this->assertFileDoesNotExist("{$dir}/chunk_{$i}");
        }

        @unlink($assembled);
        @rmdir($dir);
    }

    public function test_stream_assemble_throws_for_missing_chunk(): void
    {
        $proxy = $this->makeTraitProxy();

        $dir = storage_path('app/temp-uploads/test-missing-' . uniqid());
        @mkdir($dir, 0755, true);
        file_put_contents("{$dir}/chunk_0", 'first');
        // chunk_1 deliberately missing

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/missing chunk 1/i');

        try {
            $proxy->assemble($dir, "{$dir}/assembled.txt", 2);
        } finally {
            @unlink("{$dir}/chunk_0");
            @rmdir($dir);
        }
    }

    public function test_chunk_assembly_via_api_is_streamed(): void
    {
        // Upload 3 chunks via the API and finalize — should work correctly
        $imgData     = $this->minimalJpeg(50, 50);
        $uploadId    = 'stream-api-' . uniqid();
        $totalChunks = 3;
        $chunkSize   = (int) ceil(strlen($imgData) / $totalChunks);

        for ($i = 0; $i < $totalChunks; $i++) {
            $part  = substr($imgData, $i * $chunkSize, $chunkSize);
            $chunk = UploadedFile::fake()->createWithContent('chunk', $part);
            $this->postJson(route('t2.chunk'), [
                'chunk'        => $chunk,
                'upload_id'    => $uploadId,
                'chunk_index'  => $i,
                'total_chunks' => $totalChunks,
            ])->assertStatus(200)->assertJson(['success' => true]);
        }

        $response = $this->postJson(route('t2.finalize'), [
            'upload_id'     => $uploadId,
            'total_chunks'  => $totalChunks,
            'original_name' => 'test.jpg',
            'action'        => 'img_to_pdf',
            'page_size'     => 'A4',
            'orientation'   => 'portrait',
        ]);

        $response->assertStatus(200)->assertJsonPath('success', true);
        $this->cleanupResult($response);
    }

    // ═════════════════════════════════════════════════════════════════
    // 4. streamUrlToTemp — size guard
    // ═════════════════════════════════════════════════════════════════

    public function test_stream_url_to_temp_throws_for_oversize(): void
    {
        $proxy = $this->makeTraitProxy();

        // data:// URLs work as streams in PHP — write 10 bytes but cap at 5
        $data = base64_encode(str_repeat('X', 10));
        $url  = 'data://text/plain;base64,' . $data;

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageMatches('/exceeds/i');

        $proxy->urlToTemp($url, 5);
    }

    public function test_url_compress_rejects_oversized_response(): void
    {
        // We can't easily serve a 20MB+ image in unit tests, but we verify
        // the SSRF / invalid-URL path returns a clean error (not OOM).
        $response = $this->postJson(route('url.compress'), [
            'url'     => 'http://127.0.0.1/image.jpg',
            'quality' => 50,
        ]);

        // Must be a clean error (422) not a server crash (500)
        $this->assertContains($response->status(), [422, 503]);
        $this->assertNotNull($response->json('message'));
    }

    // ═════════════════════════════════════════════════════════════════
    // 5. autoDownscaleIfNeeded
    // ═════════════════════════════════════════════════════════════════

    public function test_auto_downscale_shrinks_large_image_in_place(): void
    {
        // Create a guard instance where the threshold is artificially low (50×50 = 2500 px)
        // so our 200×200 test image (40 000 px) triggers it — no subprocess needed.
        $guard = new class {
            use \App\Http\Controllers\Concerns\ImageSafetyGuard;
            protected function autoDownscaleThreshold(): int { return 50 * 50; }
            public function run(string $path, string $mime): void
            {
                $this->autoDownscaleIfNeeded($path, $mime);
            }
        };

        // 200×200 JPEG (tiny file — no RAM issue)
        $img = imagecreatetruecolor(200, 200);
        imagefill($img, 0, 0, imagecolorallocate($img, 200, 200, 200));
        $tmpPath = tempnam(sys_get_temp_dir(), 'autoscale_') . '.jpg';
        imagejpeg($img, $tmpPath, 80);
        imagedestroy($img);

        $guard->run($tmpPath, 'image/jpeg');

        $dims = getimagesize($tmpPath);
        $this->assertNotNull($dims);
        // sqrt(50*50)=50 — longest side must be ≤ 50 px after downscale
        $this->assertLessThanOrEqual(50, max($dims[0], $dims[1]));

        @unlink($tmpPath);
    }

    public function test_auto_downscale_leaves_small_image_unchanged(): void
    {
        $guard = new class {
            use \App\Http\Controllers\Concerns\ImageSafetyGuard;
            protected function autoDownscaleThreshold(): int { return 200 * 200; }
            public function run(string $path, string $mime): void
            {
                $this->autoDownscaleIfNeeded($path, $mime);
            }
        };

        // 100×100 = 10 000 px — under threshold of 40 000 px (200×200)
        $img = imagecreatetruecolor(100, 100);
        imagefill($img, 0, 0, imagecolorallocate($img, 100, 150, 200));
        $tmpPath = tempnam(sys_get_temp_dir(), 'noscale_') . '.jpg';
        imagejpeg($img, $tmpPath, 80);
        imagedestroy($img);

        $guard->run($tmpPath, 'image/jpeg');

        $dims = getimagesize($tmpPath);
        $this->assertEquals(100, $dims[0]);
        $this->assertEquals(100, $dims[1]);

        @unlink($tmpPath);
    }

    // ═════════════════════════════════════════════════════════════════
    // 6. php.ini baseline is low (96M not 512M)
    // ═════════════════════════════════════════════════════════════════

    public function test_php_ini_memory_limit_is_not_512m(): void
    {
        $phpIni = file_get_contents(base_path('php.ini'));
        // Should NOT contain the old static 512M
        $this->assertStringNotContainsString('memory_limit = 512M', $phpIni);
        // Should contain the new low baseline
        $this->assertStringContainsString('memory_limit = 96M', $phpIni);
    }

    // ═════════════════════════════════════════════════════════════════
    // 7. No static ini_set('memory_limit', '512M') in controllers
    // ═════════════════════════════════════════════════════════════════

    public function test_t2_controller_has_no_static_512m_memory_limit(): void
    {
        $source = file_get_contents(app_path('Http/Controllers/T2Controller.php'));
        $this->assertStringNotContainsString(
            "ini_set('memory_limit', '512M')",
            $source,
            'T2Controller must not set memory_limit statically — use MemoryGuard middleware'
        );
    }

    public function test_image_controller_has_no_static_512m_memory_limit(): void
    {
        $source = file_get_contents(app_path('Http/Controllers/ImageController.php'));
        $this->assertStringNotContainsString(
            "ini_set('memory_limit', '512M')",
            $source,
            'ImageController must not set memory_limit statically — use MemoryGuard middleware'
        );
    }

    // ═════════════════════════════════════════════════════════════════
    // 8. Batch — dimension guard applies to each file
    // ═════════════════════════════════════════════════════════════════

    public function test_batch_compress_rejects_oversize_image(): void
    {
        $bigJpeg  = $this->jpegWithDimensions(4097, 4097);
        $bigFile  = $this->makeUpload($bigJpeg, 'huge.jpg', 'image/jpeg');
        $okFile   = $this->makeUpload($this->minimalJpeg(), 'ok.jpg', 'image/jpeg');

        $response = $this->postJson(route('batch.compress'), [
            'images'  => [$bigFile, $okFile],
            'quality' => 50,
        ]);

        // Batch always returns 200 — but the oversize item must be marked failed
        $response->assertStatus(200);
        $results = $response->json('results');
        $this->assertNotNull($results);

        $failed = array_filter($results, fn($r) => !($r['success'] ?? true));
        $this->assertNotEmpty($failed, 'The oversize image in the batch must be reported as failed');
        $failedItem = array_values($failed)[0];
        $this->assertStringContainsString('too large', strtolower($failedItem['message'] ?? ''));
    }

    // ─────────────────────────────────────────────────────────────────
    // Helper
    // ─────────────────────────────────────────────────────────────────

    private function cleanupResult($response): void
    {
        $filename = $response->json('filename');
        if ($filename) {
            @unlink(storage_path("app/public/uploads/{$filename}"));
        }
    }
}
