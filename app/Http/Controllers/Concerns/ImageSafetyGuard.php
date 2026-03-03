<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

/**
 * ImageSafetyGuard
 *
 * Shared trait used by ImageController and T2Controller.
 * Provides memory-safe helpers:
 *
 *  1. guardDimensions()      — rejects images whose pixel count would exhaust RAM
 *  2. streamAssembleChunks() — assembles chunks via streams (no per-chunk RAM spike)
 *  3. streamUrlToTemp()      — downloads a remote URL to a temp file via streams
 *  4. autoDownscaleIfNeeded()— shrinks an oversized image before heavy processing
 */
trait ImageSafetyGuard
{
    /**
     * Max pixel count before we refuse to load the full image into memory.
     * 4096×4096 = ~16 MP = ~64 MB raw RGBA — safe on a 256 MB budget.
     * Override in .env: IMAGE_MAX_PIXELS
     */
    protected function maxPixels(): int
    {
        return (int) env('IMAGE_MAX_PIXELS', 4096 * 4096);
    }

    /**
     * Max pixels before we auto-downscale during resize/watermark/img-to-pdf.
     * Above this we shrink first, then process.  Set to same as maxPixels by default.
     */
    protected function autoDownscaleThreshold(): int
    {
        return (int) env('IMAGE_DOWNSCALE_PIXELS', 3000 * 3000);
    }

    /**
     * Inspect image dimensions WITHOUT loading pixel data (uses getimagesize).
     * Throws \RuntimeException if the image is too large or unreadable.
     *
     * @throws \RuntimeException
     */
    protected function guardDimensions(string $filePath): void
    {
        $info = @getimagesize($filePath);
        if ($info === false) {
            throw new \RuntimeException('Unable to read image dimensions. The file may be corrupt.');
        }
        [$w, $h] = $info;
        $pixels = $w * $h;
        if ($pixels > $this->maxPixels()) {
            $mpLimit = round($this->maxPixels() / 1_000_000, 1);
            $mpActual = round($pixels / 1_000_000, 1);
            throw new \RuntimeException(
                "Image is too large to process ({$mpActual} MP). " .
                "Maximum allowed is {$mpLimit} MP. Please resize it before uploading."
            );
        }
    }

    /**
     * Assemble chunk files into $assembledPath using file streams.
     * No chunk content is ever held in PHP memory — chunks are streamed
     * directly from disk to the output file.
     *
     * @param  string $chunkDir      Directory containing chunk_0, chunk_1, …
     * @param  string $assembledPath Full path of the file to write
     * @param  int    $totalChunks
     * @throws \RuntimeException if a chunk is missing or the write fails
     */
    protected function streamAssembleChunks(string $chunkDir, string $assembledPath, int $totalChunks): void
    {
        $out = @fopen($assembledPath, 'wb');
        if ($out === false) {
            throw new \RuntimeException('Could not open assembly target for writing.');
        }

        for ($i = 0; $i < $totalChunks; $i++) {
            $chunkPath = "{$chunkDir}/chunk_{$i}";
            if (!file_exists($chunkPath)) {
                fclose($out);
                throw new \RuntimeException("Upload incomplete. Missing chunk {$i}.");
            }
            $in = fopen($chunkPath, 'rb');
            stream_copy_to_stream($in, $out);
            fclose($in);
            @unlink($chunkPath);
        }

        fclose($out);
    }

    /**
     * Download a remote URL to a temp file using a read stream.
     * Never holds the full file in a PHP string — pipes it directly to disk.
     *
     * Returns the temp file path on success.
     * Throws \RuntimeException on failure or if the file exceeds $maxBytes.
     *
     * @throws \RuntimeException
     */
    protected function streamUrlToTemp(string $url, int $maxBytes = 20 * 1024 * 1024): string
    {
        $context = stream_context_create([
            'http' => [
                'timeout'         => 10,
                'follow_location' => true,
                'max_redirects'   => 3,
                'user_agent'      => 'CompresslyPro/1.0 Image Downloader',
            ],
            'https' => [
                'timeout'         => 10,
                'follow_location' => true,
                'max_redirects'   => 3,
                'user_agent'      => 'CompresslyPro/1.0 Image Downloader',
            ],
        ]);

        $in = @fopen($url, 'rb', false, $context);
        if ($in === false) {
            throw new \RuntimeException('Failed to download image from URL.');
        }

        $tmpPath = tempnam(sys_get_temp_dir(), 'cp_url_');
        $out     = fopen($tmpPath, 'wb');
        $written = stream_copy_to_stream($in, $out, $maxBytes + 1);
        fclose($in);
        fclose($out);

        if ($written > $maxBytes) {
            @unlink($tmpPath);
            throw new \RuntimeException('Remote image exceeds the ' . round($maxBytes / 1024 / 1024) . ' MB limit.');
        }

        return $tmpPath;
    }

    /**
     * If the image at $filePath exceeds the downscale threshold, shrink it
     * in-place (overwrite) before further processing.
     *
     * This keeps peak RAM low when processing very large source images.
     * Uses Intervention Image scaleDown() which preserves aspect ratio.
     */
    protected function autoDownscaleIfNeeded(string $filePath, string $mime): void
    {
        $info = @getimagesize($filePath);
        if ($info === false) {
            return;
        }
        [$w, $h] = $info;
        if ($w * $h <= $this->autoDownscaleThreshold()) {
            return;
        }

        // Target: ~3000 px on the longest side
        $target = (int) sqrt($this->autoDownscaleThreshold());
        $image  = Image::read($filePath);
        if ($w >= $h) {
            $image->scaleDown($target, null);
        } else {
            $image->scaleDown(null, $target);
        }

        // Re-encode in original format and overwrite
        $ext     = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $encoder = match ($ext) {
            'png'  => new \Intervention\Image\Encoders\PngEncoder(),
            'webp' => new \Intervention\Image\Encoders\WebpEncoder(quality: 85),
            'gif'  => new \Intervention\Image\Encoders\GifEncoder(),
            default => new \Intervention\Image\Encoders\JpegEncoder(quality: 85),
        };
        file_put_contents($filePath, (string) $image->encode($encoder));
        unset($image);
    }
}
