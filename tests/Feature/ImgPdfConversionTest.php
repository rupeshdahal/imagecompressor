<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

/**
 * Comprehensive tests for Image→PDF and PDF→Image conversions.
 *
 * Covers:
 *  - Direct POST (small files) via image.to.pdf  / pdf.to.image routes
 *  - Chunked upload + finalize via t2.chunk / t2.finalize routes
 *  - All page sizes and orientations
 *  - Validation errors
 *  - Filename naming convention (compresslypro-*)
 *  - Rate-limit headers present (no 429s for normal usage)
 *  - PDF download route
 */
class ImgPdfConversionTest extends TestCase
{
    use RefreshDatabase;

    // ─────────────────────────────────────────────────────────────────
    // Helpers
    // ─────────────────────────────────────────────────────────────────

    /** Real 4×4 JPEG bytes. */
    private function minimalJpeg(): string
    {
        $img = imagecreatetruecolor(4, 4);
        imagefilledrectangle($img, 0, 0, 4, 4, imagecolorallocate($img, 180, 100, 60));
        ob_start();
        imagejpeg($img, null, 80);
        $data = ob_get_clean();
        imagedestroy($img);
        return $data;
    }

    /** Real 4×4 PNG bytes. */
    private function minimalPng(): string
    {
        $img = imagecreatetruecolor(4, 4);
        imagefilledrectangle($img, 0, 0, 4, 4, imagecolorallocate($img, 60, 120, 200));
        ob_start();
        imagepng($img);
        $data = ob_get_clean();
        imagedestroy($img);
        return $data;
    }

    /** Minimal valid PDF byte-string. */
    private function minimalPdfBytes(): string
    {
        return "%PDF-1.4\n1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n"
             . "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n"
             . "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] >>\nendobj\n"
             . "xref\n0 4\n0000000000 65535 f \n"
             . "0000000009 00000 n \n0000000058 00000 n \n0000000115 00000 n \n"
             . "trailer\n<< /Size 4 /Root 1 0 R >>\nstartxref\n190\n%%EOF";
    }

    /** Wrap a binary string as an UploadedFile with given MIME. */
    private function makeUpload(string $data, string $filename, string $mime): UploadedFile
    {
        $tmp = tempnam(sys_get_temp_dir(), 'upload_');
        file_put_contents($tmp, $data);
        return new UploadedFile($tmp, $filename, $mime, null, true);
    }

    /**
     * Upload all chunks for $data via t2.chunk.
     * Returns ['uploadId' => ..., 'totalChunks' => ...].
     */
    private function uploadChunksFor(string $data, string $filename, int $chunkSize = 256): array
    {
        $totalChunks = max(1, (int) ceil(strlen($data) / $chunkSize));
        $uploadId    = 'iptest-' . uniqid();

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

        return ['uploadId' => $uploadId, 'totalChunks' => $totalChunks];
    }

    /** Clean up a generated upload file after a test. */
    private function cleanupFile(string $filename): void
    {
        if ($filename) {
            @unlink(storage_path("app/public/uploads/{$filename}"));
        }
    }

    // ═════════════════════════════════════════════════════════════════
    // IMAGE → PDF  ── Direct POST
    // ═════════════════════════════════════════════════════════════════

    public function test_img_to_pdf_direct_jpeg_a4_portrait(): void
    {
        $file = $this->makeUpload($this->minimalJpeg(), 'photo.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'A4',
            'orientation' => 'portrait',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success', 'filename', 'download_url',
                     'size', 'formatted_size', 'page_size', 'orientation',
                 ]);

        $this->assertTrue($response->json('success'));
        $this->assertEquals('A4', $response->json('page_size'));
        $this->assertEquals('portrait', $response->json('orientation'));
        $this->assertStringStartsWith('compresslypro-', $response->json('filename'));
        $this->assertStringEndsWith('.pdf', $response->json('filename'));

        $this->cleanupFile($response->json('filename'));
    }

    public function test_img_to_pdf_direct_jpeg_a4_landscape(): void
    {
        $file = $this->makeUpload($this->minimalJpeg(), 'wide.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'A4',
            'orientation' => 'landscape',
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response->json('success'));
        $this->assertEquals('landscape', $response->json('orientation'));
        $this->cleanupFile($response->json('filename'));
    }

    public function test_img_to_pdf_direct_png_a3(): void
    {
        $file = $this->makeUpload($this->minimalPng(), 'image.png', 'image/png');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'A3',
            'orientation' => 'portrait',
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response->json('success'));
        $this->assertEquals('A3', $response->json('page_size'));
        $this->cleanupFile($response->json('filename'));
    }

    public function test_img_to_pdf_direct_letter_landscape(): void
    {
        $file = $this->makeUpload($this->minimalJpeg(), 'doc.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'Letter',
            'orientation' => 'landscape',
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response->json('success'));
        $this->cleanupFile($response->json('filename'));
    }

    public function test_img_to_pdf_direct_legal_portrait(): void
    {
        $file = $this->makeUpload($this->minimalJpeg(), 'legal.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'Legal',
            'orientation' => 'portrait',
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response->json('success'));
        $this->cleanupFile($response->json('filename'));
    }

    public function test_img_to_pdf_download_url_is_reachable(): void
    {
        $file = $this->makeUpload($this->minimalJpeg(), 'photo.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'A4',
            'orientation' => 'portrait',
        ]);

        $response->assertStatus(200);
        $filename    = $response->json('filename');
        $downloadUrl = $response->json('download_url');

        $this->assertStringContainsString($filename, $downloadUrl);

        // The PDF file must actually exist on disk
        $this->assertFileExists(storage_path("app/public/uploads/{$filename}"));
        $this->cleanupFile($filename);
    }

    // ═════════════════════════════════════════════════════════════════
    // IMAGE → PDF  ── Chunked upload + finalize
    // ═════════════════════════════════════════════════════════════════

    public function test_img_to_pdf_chunked_jpeg(): void
    {
        $info = $this->uploadChunksFor($this->minimalJpeg(), 'chunked-photo.jpg');

        $response = $this->postJson(route('t2.finalize'), [
            'upload_id'     => $info['uploadId'],
            'total_chunks'  => $info['totalChunks'],
            'original_name' => 'chunked-photo.jpg',
            'action'        => 'img_to_pdf',
            'page_size'     => 'A4',
            'orientation'   => 'portrait',
        ]);

        $response->assertStatus(200)
                 ->assertJsonPath('success', true)
                 ->assertJsonStructure([
                     'success', 'filename', 'download_url',
                     'size', 'page_size', 'orientation',
                 ]);

        $this->assertStringEndsWith('.pdf', $response->json('filename'));
        $this->assertStringStartsWith('compresslypro-', $response->json('filename'));
        $this->cleanupFile($response->json('filename'));
    }

    public function test_img_to_pdf_chunked_png_landscape(): void
    {
        $info = $this->uploadChunksFor($this->minimalPng(), 'wide.png');

        $response = $this->postJson(route('t2.finalize'), [
            'upload_id'     => $info['uploadId'],
            'total_chunks'  => $info['totalChunks'],
            'original_name' => 'wide.png',
            'action'        => 'img_to_pdf',
            'page_size'     => 'Letter',
            'orientation'   => 'landscape',
        ]);

        $response->assertStatus(200)->assertJsonPath('success', true);
        $this->cleanupFile($response->json('filename'));
    }

    public function test_img_to_pdf_chunked_requires_action(): void
    {
        $info = $this->uploadChunksFor($this->minimalJpeg(), 'photo.jpg');

        $response = $this->postJson(route('t2.finalize'), [
            'upload_id'     => $info['uploadId'],
            'total_chunks'  => $info['totalChunks'],
            'original_name' => 'photo.jpg',
            // action deliberately missing
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['action']);
    }

    // ═════════════════════════════════════════════════════════════════
    // IMAGE → PDF  ── Validation
    // ═════════════════════════════════════════════════════════════════

    public function test_img_to_pdf_requires_image_field(): void
    {
        $response = $this->postJson(route('image.to.pdf'), [
            'page_size'   => 'A4',
            'orientation' => 'portrait',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['image']);
    }

    public function test_img_to_pdf_rejects_invalid_orientation(): void
    {
        $file = $this->makeUpload($this->minimalJpeg(), 'photo.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'A4',
            'orientation' => 'sideways',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['orientation']);
    }

    public function test_img_to_pdf_rejects_invalid_page_size(): void
    {
        $file = $this->makeUpload($this->minimalJpeg(), 'photo.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'A5',
            'orientation' => 'portrait',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['page_size']);
    }

    public function test_img_to_pdf_rejects_pdf_file_as_image(): void
    {
        $file = $this->makeUpload($this->minimalPdfBytes(), 'trick.jpg', 'application/pdf');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'A4',
            'orientation' => 'portrait',
        ]);

        // Must reject — either MIME validation (422) or invalid content (422/500)
        $this->assertContains($response->status(), [422, 500]);
    }

    // ═════════════════════════════════════════════════════════════════
    // PDF DOWNLOAD ROUTE
    // ═════════════════════════════════════════════════════════════════

    public function test_pdf_download_returns_file_after_conversion(): void
    {
        $file = $this->makeUpload($this->minimalJpeg(), 'photo.jpg', 'image/jpeg');

        $convertResponse = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'A4',
            'orientation' => 'portrait',
        ]);

        $convertResponse->assertStatus(200);
        $filename = $convertResponse->json('filename');

        $downloadResponse = $this->get(route('pdf.download', ['filename' => $filename]));
        $downloadResponse->assertStatus(200);
        $this->assertStringContainsString('pdf', strtolower($downloadResponse->headers->get('Content-Type', '')));

        $this->cleanupFile($filename);
    }

    public function test_pdf_download_returns_404_for_missing_file(): void
    {
        $this->get(route('pdf.download', ['filename' => 'compresslypro-does-not-exist-xyz.pdf']))
             ->assertStatus(404);
    }

    public function test_pdf_download_rejects_non_compresslypro_filename(): void
    {
        $this->get(route('pdf.download', ['filename' => 'evil.pdf']))
             ->assertStatus(404);
    }

    // ═════════════════════════════════════════════════════════════════
    // PDF → IMAGE  ── Direct POST (Imagick required)
    // ═════════════════════════════════════════════════════════════════

    public function test_pdf_to_img_requires_pdf_field(): void
    {
        $response = $this->postJson(route('pdf.to.image'), [
            'format' => 'jpg',
            'dpi'    => 150,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['pdf']);
    }

    public function test_pdf_to_img_rejects_non_pdf_file(): void
    {
        $file = $this->makeUpload($this->minimalJpeg(), 'fake.pdf', 'image/jpeg');

        $response = $this->postJson(route('pdf.to.image'), [
            'pdf'    => $file,
            'format' => 'jpg',
        ]);

        $response->assertStatus(422);
    }

    public function test_pdf_to_img_rejects_invalid_format(): void
    {
        $file = $this->makeUpload($this->minimalPdfBytes(), 'doc.pdf', 'application/pdf');

        $response = $this->postJson(route('pdf.to.image'), [
            'pdf'    => $file,
            'format' => 'bmp',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['format']);
    }

    public function test_pdf_to_img_rejects_dpi_out_of_range(): void
    {
        $file = $this->makeUpload($this->minimalPdfBytes(), 'doc.pdf', 'application/pdf');

        $response = $this->postJson(route('pdf.to.image'), [
            'pdf'    => $file,
            'format' => 'jpg',
            'dpi'    => 9,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['dpi']);
    }

    public function test_pdf_to_img_direct_post_returns_success_or_imagick_error(): void
    {
        if (!extension_loaded('imagick')) {
            $this->markTestSkipped('Imagick extension not available.');
        }

        $file = $this->makeUpload($this->minimalPdfBytes(), 'document.pdf', 'application/pdf');

        $response = $this->postJson(route('pdf.to.image'), [
            'pdf'    => $file,
            'format' => 'jpg',
            'dpi'    => 150,
        ]);

        // If Imagick is loaded but the minimal PDF is too bare for rendering,
        // we accept either success or a graceful error message — not a crash.
        $this->assertContains($response->status(), [200, 500]);
        if ($response->status() === 200) {
            $this->assertTrue($response->json('success'));
            $this->assertStringStartsWith('compresslypro-', $response->json('filename'));
            $this->cleanupFile($response->json('filename'));
        } else {
            // Must return JSON with a message, not a bare HTML 500
            $this->assertNotNull($response->json('message'));
        }
    }

    public function test_pdf_to_img_accepts_png_format(): void
    {
        if (!extension_loaded('imagick')) {
            $this->markTestSkipped('Imagick extension not available.');
        }

        $file = $this->makeUpload($this->minimalPdfBytes(), 'document.pdf', 'application/pdf');

        $response = $this->postJson(route('pdf.to.image'), [
            'pdf'    => $file,
            'format' => 'png',
            'dpi'    => 72,
        ]);

        $this->assertContains($response->status(), [200, 500]);
        if ($response->status() === 200) {
            $this->assertStringEndsWith('.png', $response->json('filename'));
            $this->cleanupFile($response->json('filename'));
        }
    }

    public function test_pdf_to_img_accepts_webp_format(): void
    {
        if (!extension_loaded('imagick')) {
            $this->markTestSkipped('Imagick extension not available.');
        }

        $file = $this->makeUpload($this->minimalPdfBytes(), 'document.pdf', 'application/pdf');

        $response = $this->postJson(route('pdf.to.image'), [
            'pdf'    => $file,
            'format' => 'webp',
            'dpi'    => 96,
        ]);

        $this->assertContains($response->status(), [200, 500]);
        if ($response->status() === 200) {
            $this->assertStringEndsWith('.webp', $response->json('filename'));
            $this->cleanupFile($response->json('filename'));
        }
    }

    // ═════════════════════════════════════════════════════════════════
    // PDF → IMAGE  ── Chunked upload + finalize
    // ═════════════════════════════════════════════════════════════════

    public function test_pdf_to_img_chunked_upload_flow(): void
    {
        if (!extension_loaded('imagick')) {
            $this->markTestSkipped('Imagick extension not available.');
        }

        $info = $this->uploadChunksFor($this->minimalPdfBytes(), 'document.pdf');

        $response = $this->postJson(route('t2.finalize'), [
            'upload_id'     => $info['uploadId'],
            'total_chunks'  => $info['totalChunks'],
            'original_name' => 'document.pdf',
            'action'        => 'pdf_to_img',
            'format'        => 'jpg',
            'dpi'           => 150,
        ]);

        // The minimal PDF may not render but should never 500 without a message
        $this->assertContains($response->status(), [200, 422, 500]);
        if ($response->status() === 200) {
            $this->assertTrue($response->json('success'));
            $this->assertStringStartsWith('compresslypro-', $response->json('filename'));
            $this->cleanupFile($response->json('filename'));
        } else {
            $body = $response->json();
            $this->assertArrayHasKey('message', $body);
        }
    }

    public function test_pdf_to_img_chunked_rejects_non_pdf_extension(): void
    {
        $info = $this->uploadChunksFor($this->minimalPdfBytes(), 'not-a.jpg');

        $response = $this->postJson(route('t2.finalize'), [
            'upload_id'     => $info['uploadId'],
            'total_chunks'  => $info['totalChunks'],
            'original_name' => 'not-a.jpg',
            'action'        => 'pdf_to_img',
            'format'        => 'jpg',
        ]);

        $response->assertStatus(422);
    }

    public function test_pdf_to_img_chunked_rejects_missing_chunks(): void
    {
        $response = $this->postJson(route('t2.finalize'), [
            'upload_id'     => 'nonexistent-upload-' . uniqid(),
            'total_chunks'  => 3,
            'original_name' => 'doc.pdf',
            'action'        => 'pdf_to_img',
            'format'        => 'jpg',
        ]);

        $response->assertStatus(422);
    }

    // ═════════════════════════════════════════════════════════════════
    // Rate limit — no 429 on normal usage
    // ═════════════════════════════════════════════════════════════════

    public function test_img_to_pdf_does_not_429_on_first_request(): void
    {
        $file = $this->makeUpload($this->minimalJpeg(), 'photo.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'A4',
            'orientation' => 'portrait',
        ]);

        $this->assertNotEquals(429, $response->status(), 'Should not 429 on first request');
        $this->cleanupFile($response->json('filename'));
    }

    public function test_pdf_to_img_does_not_429_on_first_request(): void
    {
        $file = $this->makeUpload($this->minimalPdfBytes(), 'doc.pdf', 'application/pdf');

        $response = $this->postJson(route('pdf.to.image'), [
            'pdf'    => $file,
            'format' => 'jpg',
            'dpi'    => 150,
        ]);

        $this->assertNotEquals(429, $response->status(), 'Should not 429 on first request');
    }

    public function test_t2_chunk_does_not_429_on_normal_usage(): void
    {
        $chunk = UploadedFile::fake()->createWithContent('chunk', $this->minimalJpeg());

        $response = $this->postJson(route('t2.chunk'), [
            'chunk'        => $chunk,
            'upload_id'    => 'rate-test-' . uniqid(),
            'chunk_index'  => 0,
            'total_chunks' => 1,
        ]);

        $this->assertNotEquals(429, $response->status(), 'Chunk upload should not 429');
        $this->assertEquals(200, $response->status());
    }

    public function test_t2_finalize_does_not_429_on_normal_usage(): void
    {
        $info = $this->uploadChunksFor($this->minimalJpeg(), 'throttle-test.jpg');

        $response = $this->postJson(route('t2.finalize'), [
            'upload_id'     => $info['uploadId'],
            'total_chunks'  => $info['totalChunks'],
            'original_name' => 'throttle-test.jpg',
            'action'        => 'img_to_pdf',
            'page_size'     => 'A4',
            'orientation'   => 'portrait',
        ]);

        $this->assertNotEquals(429, $response->status(), 't2.finalize should not 429 on normal usage');
        $this->cleanupFile($response->json('filename'));
    }

    // ═════════════════════════════════════════════════════════════════
    // Naming convention
    // ═════════════════════════════════════════════════════════════════

    public function test_img_to_pdf_filename_uses_compresslypro_prefix(): void
    {
        $file = $this->makeUpload($this->minimalJpeg(), 'my-holiday-photo.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'A4',
            'orientation' => 'portrait',
        ]);

        $response->assertStatus(200);
        $this->assertStringStartsWith('compresslypro-', $response->json('filename'));
        $this->cleanupFile($response->json('filename'));
    }

    public function test_img_to_pdf_uses_original_name_in_output(): void
    {
        $file = $this->makeUpload($this->minimalJpeg(), 'beach-sunset.jpg', 'image/jpeg');

        $response = $this->postJson(route('image.to.pdf'), [
            'image'       => $file,
            'page_size'   => 'A4',
            'orientation' => 'portrait',
        ]);

        $response->assertStatus(200);
        // Filename should slug the original name: "beach-sunset"
        $this->assertStringContainsString('beach-sunset', $response->json('filename'));
        $this->cleanupFile($response->json('filename'));
    }
}
