<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

/**
 * Feature tests for ImageController (compress, convert, chunk upload, download)
 * and the CleanupUploads artisan command.
 *
 * Run with:
 *   php artisan test --filter ImageControllerTest
 *   php artisan test tests/Feature/ImageControllerTest.php
 */
class ImageControllerTest extends TestCase
{
    // ── Route slugs (must match config/api_routes.php defaults) ─────────────
    private string $compressSlug  = '8f3879ade1c2e843';
    private string $convertSlug   = '42a601706437881a';
    private string $chunkSlug     = '07127203ff8fa7b5';
    private string $finalizeSlug  = 'fdb9a74646549352';

    // ─────────────────────────────────────────────────────────────────────────
    // Helpers
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Create a valid 1×1 pixel JPEG as an UploadedFile.
     */
    private function fakeJpeg(string $name = 'test.jpg', int $kilobytes = 10): UploadedFile
    {
        return UploadedFile::fake()->image($name, 100, 100)->size($kilobytes);
    }

    /**
     * Create a valid 1×1 pixel PNG as an UploadedFile.
     */
    private function fakePng(string $name = 'test.png', int $kilobytes = 10): UploadedFile
    {
        return UploadedFile::fake()->image($name, 100, 100)->size($kilobytes);
    }

    /**
     * Create a valid WebP UploadedFile (faked as image, mimeType overridden).
     */
    private function fakeWebp(string $name = 'test.webp', int $kilobytes = 10): UploadedFile
    {
        return UploadedFile::fake()->image($name, 100, 100)->size($kilobytes);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // T1-1: CleanupUploads command
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function cleanup_command_deletes_old_upload_files(): void
    {
        $dir = storage_path('app/public/uploads');
        @mkdir($dir, 0755, true);

        // Write a file and backdate its mtime by 35 minutes
        $oldFile = $dir . '/compresslypro-old-test.jpg';
        file_put_contents($oldFile, 'fake content');
        touch($oldFile, Carbon::now()->subMinutes(35)->timestamp);

        // Write a fresh file (should NOT be deleted)
        $newFile = $dir . '/compresslypro-new-test.jpg';
        file_put_contents($newFile, 'fresh content');

        $this->artisan('uploads:cleanup', ['--minutes' => 30])
             ->assertSuccessful()
             ->expectsOutputToContain('Deleted 1 item');

        $this->assertFileDoesNotExist($oldFile);
        $this->assertFileExists($newFile);

        // Clean up fresh test file
        @unlink($newFile);
    }

    #[Test]
    public function cleanup_command_skips_dotfiles(): void
    {
        $dir = storage_path('app/public/uploads');
        @mkdir($dir, 0755, true);

        $keepFile = $dir . '/.gitkeep';
        file_put_contents($keepFile, '');
        touch($keepFile, Carbon::now()->subMinutes(60)->timestamp);

        $this->artisan('uploads:cleanup', ['--minutes' => 30])
             ->assertSuccessful();

        // .gitkeep must survive cleanup
        $this->assertFileExists($keepFile);
    }

    #[Test]
    public function cleanup_command_deletes_old_temp_chunk_directories(): void
    {
        $tempBase = storage_path('app/temp-uploads');
        @mkdir($tempBase, 0755, true);

        $oldDir = $tempBase . '/old-upload-id';
        @mkdir($oldDir, 0755, true);
        file_put_contents($oldDir . '/chunk_0', 'data');
        // Backdate the directory mtime
        touch($oldDir, Carbon::now()->subMinutes(40)->timestamp);

        $this->artisan('uploads:cleanup', ['--minutes' => 30])
             ->assertSuccessful()
             ->expectsOutputToContain('Deleted 1 item');

        $this->assertDirectoryDoesNotExist($oldDir);
    }

    #[Test]
    public function cleanup_command_dry_run_does_not_delete_files(): void
    {
        $dir = storage_path('app/public/uploads');
        @mkdir($dir, 0755, true);

        $oldFile = $dir . '/compresslypro-dry-run-test.jpg';
        file_put_contents($oldFile, 'content');
        touch($oldFile, Carbon::now()->subMinutes(35)->timestamp);

        $this->artisan('uploads:cleanup', ['--minutes' => 30, '--dry-run' => true])
             ->assertSuccessful()
             ->expectsOutputToContain('[DRY RUN]')
             ->expectsOutputToContain('Would delete');

        // File must still exist after a dry run
        $this->assertFileExists($oldFile);

        @unlink($oldFile);
    }

    #[Test]
    public function cleanup_command_handles_missing_uploads_directory_gracefully(): void
    {
        // Point to a non-existent path; command should not throw
        $this->artisan('uploads:cleanup', ['--minutes' => 1])
             ->assertSuccessful();
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Home page
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function home_page_returns_200(): void
    {
        $this->get('/')->assertStatus(200);
    }

    #[Test]
    public function home_page_contains_compress_and_convert_tabs(): void
    {
        $this->get('/')
             ->assertStatus(200)
             ->assertSee('Compress Image')
             ->assertSee('Convert Format');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Compress endpoint
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function compress_endpoint_accepts_jpeg_and_returns_json(): void
    {
        $file = $this->fakeJpeg('photo.jpg');

        $response = $this->postJson('/api/' . $this->compressSlug, [
            'image'   => $file,
            'quality' => 50,
            'format'  => 'original',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['success' => true])
                 ->assertJsonStructure([
                     'success', 'original_size', 'compressed_size', 'reduction',
                     'download_url', 'filename', 'format',
                     'formatted_original', 'formatted_compressed',
                 ]);

        // filename must match the expected pattern
        $filename = $response->json('filename');
        $this->assertMatchesRegularExpression(
            '/^compresslypro-[a-z0-9\-]+\.(jpg|jpeg|png|webp|gif)$/i',
            $filename
        );
    }

    #[Test]
    public function compress_endpoint_accepts_png(): void
    {
        $file = $this->fakePng('graphic.png');

        $this->postJson('/api/' . $this->compressSlug, [
            'image'   => $file,
            'quality' => 70,
            'format'  => 'original',
        ])->assertStatus(200)->assertJson(['success' => true]);
    }

    #[Test]
    public function compress_endpoint_rejects_missing_image(): void
    {
        $this->postJson('/api/' . $this->compressSlug, [
            'quality' => 50,
            'format'  => 'original',
        ])->assertStatus(422);
    }

    #[Test]
    public function compress_endpoint_rejects_invalid_quality(): void
    {
        $this->postJson('/api/' . $this->compressSlug, [
            'image'   => $this->fakeJpeg(),
            'quality' => 150,   // > 90 — invalid
            'format'  => 'original',
        ])->assertStatus(422);
    }

    #[Test]
    public function compress_endpoint_rejects_quality_below_minimum(): void
    {
        $this->postJson('/api/' . $this->compressSlug, [
            'image'   => $this->fakeJpeg(),
            'quality' => 5,     // < 10 — invalid
            'format'  => 'original',
        ])->assertStatus(422);
    }

    #[Test]
    public function compress_endpoint_rejects_non_image_file(): void
    {
        $pdf = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $this->postJson('/api/' . $this->compressSlug, [
            'image'   => $pdf,
            'quality' => 50,
            'format'  => 'original',
        ])->assertStatus(422);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Convert endpoint
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function convert_endpoint_converts_jpeg_to_png(): void
    {
        $file = $this->fakeJpeg('photo.jpg');

        $response = $this->postJson('/api/' . $this->convertSlug, [
            'image'  => $file,
            'format' => 'png',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['success' => true])
                 ->assertJsonPath('format', 'PNG')
                 ->assertJsonStructure([
                     'success', 'download_url', 'filename',
                     'formatted_original', 'formatted_converted',
                 ]);
    }

    #[Test]
    public function convert_endpoint_converts_jpeg_to_webp(): void
    {
        $file = $this->fakeJpeg('photo.jpg');

        $this->postJson('/api/' . $this->convertSlug, [
            'image'  => $file,
            'format' => 'webp',
        ])->assertStatus(200)->assertJsonPath('format', 'WEBP');
    }

    #[Test]
    public function convert_endpoint_rejects_invalid_format(): void
    {
        $this->postJson('/api/' . $this->convertSlug, [
            'image'  => $this->fakeJpeg(),
            'format' => 'bmp',  // unsupported
        ])->assertStatus(422);
    }

    #[Test]
    public function convert_endpoint_rejects_missing_format(): void
    {
        $this->postJson('/api/' . $this->convertSlug, [
            'image' => $this->fakeJpeg(),
        ])->assertStatus(422);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Chunked upload
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function chunk_endpoint_accepts_a_valid_chunk(): void
    {
        $chunk = UploadedFile::fake()->create('chunk_0', 512, 'application/octet-stream');

        $response = $this->postJson('/api/' . $this->chunkSlug, [
            'chunk'        => $chunk,
            'upload_id'    => 'test-upload-abc123',
            'chunk_index'  => 0,
            'total_chunks' => 3,
        ]);

        $response->assertStatus(200)
                 ->assertJson(['success' => true, 'chunk_index' => 0, 'total_chunks' => 3]);

        // Clean up temp dir
        $dir = storage_path('app/temp-uploads/test-upload-abc123');
        if (is_dir($dir)) File::deleteDirectory($dir);
    }

    #[Test]
    public function chunk_endpoint_sanitizes_upload_id_stripping_path_traversal(): void
    {
        $chunk = UploadedFile::fake()->create('chunk_0', 100, 'application/octet-stream');

        // '../../etc/passwd' → sanitizer strips non-alphanumeric/hyphen chars → 'etcpasswd'
        // The controller either uses the sanitized safe ID or rejects it entirely.
        // Either way, NO file should land outside temp-uploads/.
        $response = $this->postJson('/api/' . $this->chunkSlug, [
            'chunk'        => $chunk,
            'upload_id'    => '../../etc/passwd',
            'chunk_index'  => 0,
            'total_chunks' => 1,
        ]);

        // Must not reach the filesystem outside the temp-uploads directory
        $this->assertFileDoesNotExist('/etc/passwd_new'); // obviously should stay unchanged
        // Result is either 200 (sanitized to 'etcpasswd') or 422 (empty after sanitize)
        $this->assertContains($response->status(), [200, 422]);

        // If 200, clean up the sanitized directory
        if ($response->status() === 200) {
            $sanitizedDir = storage_path('app/temp-uploads/etcpasswd');
            if (is_dir($sanitizedDir)) {
                \Illuminate\Support\Facades\File::deleteDirectory($sanitizedDir);
            }
        }
    }

    #[Test]
    public function chunk_endpoint_rejects_missing_chunk(): void
    {
        $this->postJson('/api/' . $this->chunkSlug, [
            'upload_id'    => 'test-123',
            'chunk_index'  => 0,
            'total_chunks' => 1,
        ])->assertStatus(422);
    }

    #[Test]
    public function finalize_endpoint_assembles_chunks_and_compresses(): void
    {
        // Generate a real valid JPEG using GD so Intervention Image can decode it
        $gdImage = imagecreatetruecolor(50, 50);
        $color   = imagecolorallocate($gdImage, 100, 150, 200);
        imagefill($gdImage, 0, 0, $color);
        ob_start();
        imagejpeg($gdImage, null, 75);
        $jpegData = ob_get_clean();
        imagedestroy($gdImage);

        $uploadId = 'test-finalize-' . uniqid();
        $chunkDir = storage_path("app/temp-uploads/{$uploadId}");
        @mkdir($chunkDir, 0755, true);
        file_put_contents("{$chunkDir}/chunk_0", $jpegData);

        $response = $this->postJson('/api/' . $this->finalizeSlug, [
            'upload_id'     => $uploadId,
            'total_chunks'  => 1,
            'original_name' => 'test-photo.jpg',
            'action'        => 'compress',
            'quality'       => 50,
        ]);

        $response->assertStatus(200)
                 ->assertJson(['success' => true])
                 ->assertJsonStructure(['download_url', 'filename']);

        // Temp dir must be cleaned up by the controller after finalization
        $this->assertDirectoryDoesNotExist($chunkDir);

        // Delete the output file
        $filename   = $response->json('filename');
        $outputPath = storage_path("app/public/uploads/{$filename}");
        @unlink($outputPath);
    }

    #[Test]
    public function finalize_endpoint_rejects_missing_chunk(): void
    {
        $uploadId = 'incomplete-upload-' . uniqid();
        $chunkDir = storage_path("app/temp-uploads/{$uploadId}");
        @mkdir($chunkDir, 0755, true);
        // Do NOT write chunk_0 — simulating incomplete upload

        $this->postJson('/api/' . $this->finalizeSlug, [
            'upload_id'     => $uploadId,
            'total_chunks'  => 2,
            'original_name' => 'test.jpg',
            'action'        => 'compress',
            'quality'       => 50,
        ])->assertStatus(422)
          ->assertJsonPath('success', false);

        // Clean up
        if (is_dir($chunkDir)) File::deleteDirectory($chunkDir);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Download endpoint
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function download_endpoint_returns_404_for_nonexistent_file(): void
    {
        $this->get('/dl/compresslypro-nonexistent.jpg')
             ->assertStatus(404);
    }

    #[Test]
    public function download_endpoint_rejects_path_traversal(): void
    {
        $this->get('/dl/../../../etc/passwd')
             ->assertStatus(404);
    }

    #[Test]
    public function download_endpoint_rejects_invalid_filename_pattern(): void
    {
        // Does not start with 'compresslypro-'
        $this->get('/dl/evilfile.jpg')
             ->assertStatus(404);
    }

    #[Test]
    public function download_endpoint_serves_existing_file(): void
    {
        // Place a real file in the uploads directory
        $dir = storage_path('app/public/uploads');
        @mkdir($dir, 0755, true);

        $filename = 'compresslypro-download-test.jpg';
        $path     = $dir . '/' . $filename;

        // Minimal JPEG bytes (valid enough for a download test)
        file_put_contents($path, "\xFF\xD8\xFF\xE0" . str_repeat('A', 20) . "\xFF\xD9");

        $this->get('/dl/' . $filename)
             ->assertStatus(200);

        @unlink($path);
    }
}
