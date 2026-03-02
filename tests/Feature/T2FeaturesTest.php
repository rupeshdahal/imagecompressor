<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

/**
 * Feature tests for T2Controller (batch compress, resize, image→PDF,
 * PDF→image, watermark, URL compress) and admin CSV export.
 *
 * Run with:
 *   php artisan test --filter T2FeaturesTest
 *   php artisan test tests/Feature/T2FeaturesTest.php
 */
class T2FeaturesTest extends TestCase
{
    use RefreshDatabase;
    // ── Route slugs (must match config/api_routes.php defaults) ─────────────
    private string $batchSlug   = 'c3f1a2b4d5e6f7a8';
    private string $batchZip    = 'b8e7d6c5f4a3b2c1';
    private string $resizeSlug  = 'a1b2c3d4e5f6a7b8';
    private string $imgToPdf    = 'e2d3c4b5a6f7e8d9';
    private string $pdfToImg    = 'd9c8b7a6f5e4d3c2';
    private string $watermark   = 'c2b1a0f9e8d7c6b5';
    private string $urlCompress = 'f9e8d7c6b5a4f3e2';

    // ── Helpers ──────────────────────────────────────────────────────────────

    private function fakeJpeg(string $name = 'test.jpg', int $w = 200, int $h = 200): UploadedFile
    {
        return UploadedFile::fake()->image($name, $w, $h);
    }

    private function fakePng(string $name = 'test.png', int $w = 200, int $h = 200): UploadedFile
    {
        return UploadedFile::fake()->image($name, $w, $h);
    }

    /** Create a minimal valid PDF byte-string and wrap it as UploadedFile */
    private function fakePdf(string $name = 'test.pdf'): UploadedFile
    {
        $content = "%PDF-1.4\n1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n"
                 . "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n"
                 . "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] >>\nendobj\n"
                 . "xref\n0 4\n0000000000 65535 f \n"
                 . "0000000009 00000 n \n0000000058 00000 n \n0000000115 00000 n \n"
                 . "trailer\n<< /Size 4 /Root 1 0 R >>\nstartxref\n190\n%%EOF";

        $tmp = tempnam(sys_get_temp_dir(), 'pdf_') . '.pdf';
        file_put_contents($tmp, $content);

        return new UploadedFile($tmp, $name, 'application/pdf', null, true);
    }

    private function makeAdmin(): User
    {
        $user = User::factory()->create(['is_admin' => true]);
        return $user;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // T2-1: Batch Compress
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function batch_compress_with_multiple_images_returns_results(): void
    {
        $response = $this->postJson('/api/' . $this->batchSlug, [
            'images' => [
                $this->fakeJpeg('img1.jpg'),
                $this->fakeJpeg('img2.jpg'),
                $this->fakePng('img3.png'),
            ],
            'quality' => 50,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'batch_id',
                     'total',
                     'succeeded',
                     'failed',
                     'results' => [
                         '*' => ['success', 'original_name'],
                     ],
                     'filenames',
                 ]);

        $this->assertTrue($response->json('success'));
        $this->assertEquals(3, $response->json('total'));
        $this->assertGreaterThanOrEqual(1, $response->json('succeeded'));
    }

    #[Test]
    public function batch_compress_validates_images_field_required(): void
    {
        $response = $this->postJson('/api/' . $this->batchSlug, [
            'quality' => 50,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['images']);
    }

    #[Test]
    public function batch_compress_rejects_more_than_20_files(): void
    {
        $images = [];
        for ($i = 0; $i < 21; $i++) {
            $images[] = $this->fakeJpeg("img{$i}.jpg");
        }

        $response = $this->postJson('/api/' . $this->batchSlug, [
            'images'  => $images,
            'quality' => 50,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['images']);
    }

    #[Test]
    public function batch_compress_rejects_non_image_files(): void
    {
        $response = $this->postJson('/api/' . $this->batchSlug, [
            'images' => [
                UploadedFile::fake()->create('document.pdf', 10, 'application/pdf'),
            ],
            'quality' => 50,
        ]);

        $response->assertStatus(422);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // T2-1: Batch ZIP Download
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function batch_zip_rejects_path_traversal_filenames(): void
    {
        $response = $this->postJson('/api/' . $this->batchZip, [
            'filenames' => ['../../etc/passwd'],
            'batch_id'  => 'abc123',
        ]);

        $response->assertStatus(422);
    }

    #[Test]
    public function batch_zip_validates_filenames_required(): void
    {
        $response = $this->postJson('/api/' . $this->batchZip, [
            'batch_id' => 'abc123',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['filenames']);
    }

    #[Test]
    public function batch_zip_returns_404_when_no_valid_files_found(): void
    {
        $response = $this->postJson('/api/' . $this->batchZip, [
            'filenames' => ['compresslypro-nonexistent-file.jpg'],
            'batch_id'  => 'abc123',
        ]);

        // Either 404 (no files found) or a valid ZIP stream
        $this->assertContains($response->getStatusCode(), [200, 404]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // T2-2: Image Resize
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function resize_max_width_mode_returns_success(): void
    {
        $response = $this->postJson('/api/' . $this->resizeSlug, [
            'image' => $this->fakeJpeg('photo.jpg', 400, 300),
            'mode'  => 'max_width',
            'width' => 200,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'original_name',
                     'download_url',
                     'original_size',
                     'resized_size',
                     'formatted_original',
                     'formatted_resized',
                     'width',
                     'height',
                 ]);

        $this->assertTrue($response->json('success'));
        $this->assertLessThanOrEqual(200, $response->json('width'));
    }

    #[Test]
    public function resize_max_height_mode_returns_success(): void
    {
        $response = $this->postJson('/api/' . $this->resizeSlug, [
            'image'  => $this->fakeJpeg('photo.jpg', 400, 400),
            'mode'   => 'max_height',
            'height' => 150,
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response->json('success'));
        $this->assertLessThanOrEqual(150, $response->json('height'));
    }

    #[Test]
    public function resize_percentage_mode_returns_success(): void
    {
        $response = $this->postJson('/api/' . $this->resizeSlug, [
            'image'      => $this->fakeJpeg('photo.jpg', 400, 300),
            'mode'       => 'percentage',
            'percentage' => 50,
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response->json('success'));
    }

    #[Test]
    public function resize_exact_mode_returns_success(): void
    {
        $response = $this->postJson('/api/' . $this->resizeSlug, [
            'image'  => $this->fakeJpeg('photo.jpg', 400, 400),
            'mode'   => 'exact',
            'width'  => 100,
            'height' => 100,
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response->json('success'));
        $this->assertEquals(100, $response->json('width'));
        $this->assertEquals(100, $response->json('height'));
    }

    #[Test]
    public function resize_validates_image_required(): void
    {
        $response = $this->postJson('/api/' . $this->resizeSlug, [
            'mode'  => 'max_width',
            'width' => 200,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['image']);
    }

    #[Test]
    public function resize_validates_mode_required(): void
    {
        $response = $this->postJson('/api/' . $this->resizeSlug, [
            'image' => $this->fakeJpeg(),
            'width' => 200,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['mode']);
    }

    #[Test]
    public function resize_rejects_invalid_mode(): void
    {
        $response = $this->postJson('/api/' . $this->resizeSlug, [
            'image' => $this->fakeJpeg(),
            'mode'  => 'invalid_mode',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['mode']);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // T2-3: Image → PDF
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function image_to_pdf_converts_jpeg_and_returns_download_url(): void
    {
        $response = $this->postJson('/api/' . $this->imgToPdf, [
            'image'       => $this->fakeJpeg('photo.jpg', 200, 200),
            'page_size'   => 'A4',
            'orientation' => 'portrait',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'download_url',
                     'filename',
                     'size',
                     'formatted_size',
                 ]);

        $this->assertTrue($response->json('success'));
        $this->assertStringContainsString('.pdf', $response->json('filename'));
    }

    #[Test]
    public function image_to_pdf_converts_png_landscape(): void
    {
        $response = $this->postJson('/api/' . $this->imgToPdf, [
            'image'       => $this->fakePng('image.png', 300, 200),
            'page_size'   => 'Letter',
            'orientation' => 'landscape',
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response->json('success'));
    }

    #[Test]
    public function image_to_pdf_validates_image_required(): void
    {
        $response = $this->postJson('/api/' . $this->imgToPdf, [
            'page_size'   => 'A4',
            'orientation' => 'portrait',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['image']);
    }

    #[Test]
    public function image_to_pdf_validates_orientation_values(): void
    {
        $response = $this->postJson('/api/' . $this->imgToPdf, [
            'image'       => $this->fakeJpeg(),
            'page_size'   => 'A4',
            'orientation' => 'diagonal',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['orientation']);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // T2-3: PDF Download route
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function pdf_download_returns_404_for_nonexistent_file(): void
    {
        $response = $this->get('/pdf/compresslypro-does-not-exist.pdf');
        $response->assertStatus(404);
    }

    #[Test]
    public function pdf_download_rejects_path_traversal(): void
    {
        $response = $this->get('/pdf/../../etc/passwd');
        // Laravel router will 404 due to pattern constraint or 400
        $this->assertContains($response->getStatusCode(), [400, 404, 302]);
    }

    #[Test]
    public function pdf_download_rejects_non_pdf_filename_pattern(): void
    {
        $response = $this->get('/pdf/evil-script.exe');
        $this->assertContains($response->getStatusCode(), [400, 404, 302]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // T2-5: Watermark
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function watermark_adds_text_to_image_and_returns_success(): void
    {
        $response = $this->postJson('/api/' . $this->watermark, [
            'image'    => $this->fakeJpeg('photo.jpg', 400, 300),
            'text'     => '© MyBrand',
            'position' => 'bottom-right',
            'opacity'  => 70,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'download_url',
                     'original_name',
                     'size',
                     'formatted_size',
                 ]);

        $this->assertTrue($response->json('success'));
    }

    #[Test]
    public function watermark_validates_text_required(): void
    {
        $response = $this->postJson('/api/' . $this->watermark, [
            'image'    => $this->fakeJpeg(),
            'position' => 'center',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['text']);
    }

    #[Test]
    public function watermark_validates_image_required(): void
    {
        $response = $this->postJson('/api/' . $this->watermark, [
            'text'     => '© Test',
            'position' => 'center',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['image']);
    }

    #[Test]
    public function watermark_validates_position_values(): void
    {
        $response = $this->postJson('/api/' . $this->watermark, [
            'image'    => $this->fakeJpeg(),
            'text'     => '© Test',
            'position' => 'invalid-corner',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['position']);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // T2-6: URL Compress
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function url_compress_validates_url_required(): void
    {
        $response = $this->postJson('/api/' . $this->urlCompress, [
            'quality' => 50,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['url']);
    }

    #[Test]
    public function url_compress_blocks_private_ip_127(): void
    {
        $response = $this->postJson('/api/' . $this->urlCompress, [
            'url'     => 'http://127.0.0.1/secret.jpg',
            'quality' => 50,
        ]);

        $response->assertStatus(422);
    }

    #[Test]
    public function url_compress_blocks_private_ip_192_168(): void
    {
        $response = $this->postJson('/api/' . $this->urlCompress, [
            'url'     => 'http://192.168.1.1/image.jpg',
            'quality' => 50,
        ]);

        $response->assertStatus(422);
    }

    #[Test]
    public function url_compress_blocks_private_ip_10_x(): void
    {
        $response = $this->postJson('/api/' . $this->urlCompress, [
            'url'     => 'http://10.0.0.1/image.jpg',
            'quality' => 50,
        ]);

        $response->assertStatus(422);
    }

    #[Test]
    public function url_compress_rejects_ftp_scheme(): void
    {
        $response = $this->postJson('/api/' . $this->urlCompress, [
            'url'     => 'ftp://example.com/image.jpg',
            'quality' => 50,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['url']);
    }

    #[Test]
    public function url_compress_rejects_file_scheme(): void
    {
        $response = $this->postJson('/api/' . $this->urlCompress, [
            'url'     => 'file:///etc/passwd',
            'quality' => 50,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['url']);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // T2-4: PDF → Image
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function pdf_to_image_validates_pdf_required(): void
    {
        $response = $this->postJson('/api/' . $this->pdfToImg, [
            'format' => 'jpg',
            'dpi'    => 150,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['pdf']);
    }

    #[Test]
    public function pdf_to_image_rejects_non_pdf_file(): void
    {
        $response = $this->postJson('/api/' . $this->pdfToImg, [
            'pdf'    => $this->fakeJpeg('not-a-pdf.jpg'),
            'format' => 'jpg',
            'dpi'    => 150,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['pdf']);
    }

    #[Test]
    public function pdf_to_image_validates_format_values(): void
    {
        $response = $this->postJson('/api/' . $this->pdfToImg, [
            'pdf'    => $this->fakePdf(),
            'format' => 'bmp',
            'dpi'    => 150,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['format']);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // T2-7: Admin CSV Export
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function admin_export_requires_authentication(): void
    {
        $response = $this->get('/admin/export');
        $response->assertRedirect('/authorize');
    }

    #[Test]
    public function admin_export_returns_csv_for_authenticated_admin(): void
    {
        $admin = $this->makeAdmin();
        $response = $this->actingAs($admin)->get('/admin/export?period=all');

        $response->assertStatus(200);
        $this->assertStringContainsString(
            'text/csv',
            $response->headers->get('Content-Type') ?? ''
        );
        $this->assertStringContainsString(
            'attachment',
            $response->headers->get('Content-Disposition') ?? ''
        );
    }

    #[Test]
    public function admin_export_csv_contains_headers_row(): void
    {
        $admin = $this->makeAdmin();
        $response = $this->actingAs($admin)->get('/admin/export?period=all');

        $response->assertStatus(200);
        $content = $response->streamedContent();
        $this->assertStringContainsString('ID', $content);
        $this->assertStringContainsString('Action', $content);
        $this->assertStringContainsString('Original Name', $content);
    }

    #[Test]
    public function admin_export_non_admin_user_is_redirected(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $response = $this->actingAs($user)->get('/admin/export');
        $response->assertRedirect();
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Regression: existing compress + convert still work
    // ─────────────────────────────────────────────────────────────────────────

    #[Test]
    public function existing_compress_endpoint_still_works_after_t2(): void
    {
        $response = $this->postJson('/api/8f3879ade1c2e843', [
            'image'   => $this->fakeJpeg('photo.jpg', 200, 200),
            'quality' => 50,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['success', 'download_url', 'reduction']);
        $this->assertTrue($response->json('success'));
    }

    #[Test]
    public function existing_convert_endpoint_still_works_after_t2(): void
    {
        $response = $this->postJson('/api/42a601706437881a', [
            'image'  => $this->fakeJpeg('photo.jpg', 200, 200),
            'format' => 'webp',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['success', 'download_url']);
        $this->assertTrue($response->json('success'));
    }
}
