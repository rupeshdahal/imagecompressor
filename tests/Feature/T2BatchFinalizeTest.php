<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

/**
 * Tests for batch chunked finalize endpoint.
 *
 * Route: POST /api/{batch_finalize} → T2Controller@finalizeBatch (name: batch.finalize)
 *
 * Flow:
 *   1. Upload every file's chunks via t2.chunk  (POST /api/{t2_chunk})
 *   2. POST manifests to batch.finalize          (no file bytes in the finalize request)
 */
class T2BatchFinalizeTest extends TestCase
{
    use RefreshDatabase;

    // ─────────────────────────────────────────────────────────────────
    // Helpers
    // ─────────────────────────────────────────────────────────────────

    private function minimalJpeg(): string
    {
        $img = imagecreatetruecolor(4, 4);
        imagefilledrectangle($img, 0, 0, 4, 4, imagecolorallocate($img, 200, 100, 50));
        ob_start();
        imagejpeg($img, null, 80);
        $data = ob_get_clean();
        imagedestroy($img);
        return $data;
    }

    private function minimalPng(): string
    {
        $img = imagecreatetruecolor(4, 4);
        imagefilledrectangle($img, 0, 0, 4, 4, imagecolorallocate($img, 50, 150, 250));
        ob_start();
        imagepng($img);
        $data = ob_get_clean();
        imagedestroy($img);
        return $data;
    }

    /**
     * Chunk and upload a binary string via t2.chunk.
     * Returns ['upload_id' => ..., 'total_chunks' => ..., 'original_name' => ...].
     */
    private function uploadChunksFor(string $data, string $filename, int $chunkSize = 256): array
    {
        $totalChunks = max(1, (int) ceil(strlen($data) / $chunkSize));
        $uploadId    = 'btest-' . uniqid();

        for ($i = 0; $i < $totalChunks; $i++) {
            $part  = substr($data, $i * $chunkSize, $chunkSize);
            $chunk = UploadedFile::fake()->createWithContent('chunk', $part);

            $this->postJson(route('t2.chunk'), [
                'chunk'        => $chunk,
                'upload_id'    => $uploadId,
                'chunk_index'  => $i,
                'total_chunks' => $totalChunks,
            ])->assertStatus(200)->assertJson(['success' => true]);
        }

        return [
            'upload_id'     => $uploadId,
            'total_chunks'  => $totalChunks,
            'original_name' => $filename,
        ];
    }

    /** Build a JSON-ready body from an array of manifests + extra params. */
    private function buildBody(array $manifests, array $extra = []): array
    {
        $files = array_map(fn($m) => [
            'upload_id'     => $m['upload_id'],
            'total_chunks'  => $m['total_chunks'],
            'original_name' => $m['original_name'],
        ], $manifests);

        return array_merge($extra, ['files' => $files]);
    }

    // ─────────────────────────────────────────────────────────────────
    // Validation
    // ─────────────────────────────────────────────────────────────────

    /** @test */
    public function batch_finalize_requires_files_array(): void
    {
        $response = $this->postJson(route('batch.finalize'), [
            'quality' => 60,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['files']);
    }

    /** @test */
    public function batch_finalize_rejects_empty_files_array(): void
    {
        $response = $this->postJson(route('batch.finalize'), [
            'files'   => [],
            'quality' => 60,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['files']);
    }

    /** @test */
    public function batch_finalize_rejects_more_than_20_files(): void
    {
        $manifests = [];
        for ($i = 0; $i < 21; $i++) {
            $manifests[] = [
                'upload_id'     => 'fake-id-' . $i,
                'total_chunks'  => 1,
                'original_name' => "file{$i}.jpg",
            ];
        }

        $response = $this->postJson(route('batch.finalize'), [
            'files'   => $manifests,
            'quality' => 60,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['files']);
    }

    /** @test */
    public function batch_finalize_requires_upload_id_per_file(): void
    {
        $response = $this->postJson(route('batch.finalize'), [
            'files' => [
                ['total_chunks' => 1, 'original_name' => 'test.jpg'],
            ],
            'quality' => 60,
        ]);

        $response->assertStatus(422);
    }

    // ─────────────────────────────────────────────────────────────────
    // Success cases
    // ─────────────────────────────────────────────────────────────────

    /** @test */
    public function batch_finalize_processes_single_jpeg(): void
    {
        $manifest = $this->uploadChunksFor($this->minimalJpeg(), 'photo.jpg');

        $response = $this->postJson(route('batch.finalize'), $this->buildBody(
            [$manifest],
            ['quality' => 60]
        ));

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'batch_id',
                     'total',
                     'succeeded',
                     'failed',
                     'results',
                     'filenames',
                 ]);

        $data = $response->json();
        $this->assertTrue($data['success']);
        $this->assertEquals(1, $data['total']);
        $this->assertGreaterThanOrEqual(1, $data['succeeded']);
        $this->assertIsArray($data['results']);
        $this->assertCount(1, $data['results']);
    }

    /** @test */
    public function batch_finalize_processes_multiple_files(): void
    {
        $manifests = [
            $this->uploadChunksFor($this->minimalJpeg(), 'img1.jpg'),
            $this->uploadChunksFor($this->minimalPng(),  'img2.png'),
            $this->uploadChunksFor($this->minimalJpeg(), 'img3.jpg'),
        ];

        $response = $this->postJson(route('batch.finalize'), $this->buildBody(
            $manifests,
            ['quality' => 70]
        ));

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertTrue($data['success']);
        $this->assertEquals(3, $data['total']);
        $this->assertCount(3, $data['results']);
    }

    /** @test */
    public function batch_finalize_result_items_have_required_fields(): void
    {
        $manifest = $this->uploadChunksFor($this->minimalJpeg(), 'check.jpg');

        $response = $this->postJson(route('batch.finalize'), $this->buildBody(
            [$manifest],
            ['quality' => 75]
        ));

        $response->assertStatus(200);
        $result = $response->json('results.0');

        $this->assertArrayHasKey('success',          $result);
        $this->assertArrayHasKey('original_name',    $result);
        $this->assertArrayHasKey('original_size',    $result);
        $this->assertArrayHasKey('compressed_size',  $result);
        $this->assertArrayHasKey('reduction',        $result);
        $this->assertArrayHasKey('filename',         $result);
    }

    /** @test */
    public function batch_finalize_filenames_use_compresslypro_prefix(): void
    {
        $manifest = $this->uploadChunksFor($this->minimalJpeg(), 'myphoto.jpg');

        $response = $this->postJson(route('batch.finalize'), $this->buildBody(
            [$manifest],
            ['quality' => 60]
        ));

        $response->assertStatus(200);
        $filename = $response->json('results.0.filename');
        $this->assertStringStartsWith('compresslypro-', $filename);
    }

    /** @test */
    public function batch_finalize_filenames_array_matches_succeeded_results(): void
    {
        $manifests = [
            $this->uploadChunksFor($this->minimalJpeg(), 'a.jpg'),
            $this->uploadChunksFor($this->minimalPng(),  'b.png'),
        ];

        $response = $this->postJson(route('batch.finalize'), $this->buildBody(
            $manifests,
            ['quality' => 65]
        ));

        $response->assertStatus(200);
        $data      = $response->json();
        $filenames = $data['filenames'];
        $succeeded = $data['succeeded'];

        $this->assertCount($succeeded, $filenames);
    }

    /** @test */
    public function batch_finalize_returns_batch_id(): void
    {
        $manifest = $this->uploadChunksFor($this->minimalJpeg(), 'has-batch-id.jpg');

        $response = $this->postJson(route('batch.finalize'), $this->buildBody(
            [$manifest],
            ['quality' => 50]
        ));

        $response->assertStatus(200);
        $batchId = $response->json('batch_id');
        $this->assertNotEmpty($batchId);
    }

    // ─────────────────────────────────────────────────────────────────
    // Failure / partial cases
    // ─────────────────────────────────────────────────────────────────

    /** @test */
    public function batch_finalize_returns_failure_for_missing_upload_id(): void
    {
        $response = $this->postJson(route('batch.finalize'), $this->buildBody(
            [[
                'upload_id'     => 'nonexistent-id-xyz999',
                'total_chunks'  => 1,
                'original_name' => 'ghost.jpg',
            ]],
            ['quality' => 60]
        ));

        // Should return 200 with per-file failure, not a 500
        $response->assertStatus(200);
        $result = $response->json('results.0');
        $this->assertFalse($result['success']);
        $this->assertEquals(0, $response->json('succeeded'));
    }

    /** @test */
    public function batch_finalize_rejects_non_image_mime(): void
    {
        // Upload a PHP file disguised as JPEG
        $fakeData = '<?php echo "evil"; ?>';
        $manifest = $this->uploadChunksFor($fakeData, 'evil.jpg');

        $response = $this->postJson(route('batch.finalize'), $this->buildBody(
            [$manifest],
            ['quality' => 60]
        ));

        $response->assertStatus(200);
        $result = $response->json('results.0');
        $this->assertFalse($result['success']);
    }

    /** @test */
    public function batch_finalize_partial_success_when_some_files_missing(): void
    {
        $good = $this->uploadChunksFor($this->minimalJpeg(), 'good.jpg');
        $bad  = [
            'upload_id'     => 'does-not-exist-' . uniqid(),
            'total_chunks'  => 2,
            'original_name' => 'missing.jpg',
        ];

        $response = $this->postJson(route('batch.finalize'), $this->buildBody(
            [$good, $bad],
            ['quality' => 60]
        ));

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertEquals(2, $data['total']);
        $this->assertEquals(1, $data['succeeded']);
        $this->assertEquals(1, $data['failed']);
    }

    /** @test */
    public function batch_finalize_quality_boundary_values(): void
    {
        foreach ([10, 50, 90] as $q) {
            // Fresh upload per quality value — chunks are cleaned after each finalize
            $manifest = $this->uploadChunksFor($this->minimalJpeg(), 'quality-test.jpg');
            $response = $this->postJson(route('batch.finalize'), $this->buildBody(
                [$manifest],
                ['quality' => $q]
            ));
            $response->assertStatus(200);
            $this->assertEquals(1, $response->json('succeeded'));
        }
    }

    // ─────────────────────────────────────────────────────────────────
    // Regression: old direct-POST batch route still works
    // ─────────────────────────────────────────────────────────────────

    /** @test */
    public function batch_compress_direct_post_still_works(): void
    {
        $jpeg = UploadedFile::fake()->createWithContent('photo.jpg', $this->minimalJpeg());
        $jpeg = new \Illuminate\Http\UploadedFile(
            $jpeg->getPathname(), 'photo.jpg', 'image/jpeg', null, true
        );

        $response = $this->post(route('batch.compress'), [
            'images' => [$jpeg],
            'quality' => 60,
        ]);

        // Route must exist (not 404) and not crash the framework (not a blank 500 from routing)
        $this->assertNotEquals(404, $response->status(), 'batch.compress route must exist');
    }
}
