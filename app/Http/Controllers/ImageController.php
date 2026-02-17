<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\RateLimiter;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Encoders\GifEncoder;
use Intervention\Image\Typography\FontFactory;
use App\Models\CompressionReport;

class ImageController extends Controller
{
    /**
     * Maximum file size in bytes (20MB).
     */
    private const MAX_FILE_SIZE = 20 * 1024 * 1024;

    /**
     * Allowed MIME types.
     */
    private const ALLOWED_MIMES = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
    ];

    /**
     * MIME to extension mapping.
     */
    private const MIME_TO_EXT = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
        'image/gif'  => 'gif',
    ];

    /**
     * Show the home page (landing).
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the compressor tool page.
     */
    public function compressor()
    {
        return view('compressor');
    }

    /**
     * Show the watermark tool page.
     */
    public function watermarkPage()
    {
        return view('watermark');
    }

    /**
     * Handle image compression via AJAX.
     */
    public function compress(Request $request): JsonResponse
    {
        // Increase memory limit for large image processing
        ini_set('memory_limit', '512M');

        // Rate limiting: 30 requests per minute per IP
        $key = 'compress:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 30)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Too many requests. Please try again in {$seconds} seconds.",
            ], 429);
        }
        RateLimiter::hit($key, 60);

        // Validate request
        $validated = $request->validate([
            'image'              => 'required|file|mimes:jpeg,jpg,png,webp,gif|max:20480', // 20MB = 20480 KB
            'quality'            => 'required|integer|min:10|max:90',
            'format'             => 'nullable|string|in:original,jpg,png,webp',
        ]);

        try {
            $file = $request->file('image');

            // Double-check MIME type (security)
            $mime = $file->getMimeType();
            if (!in_array($mime, self::ALLOWED_MIMES, true)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid file type. Only JPG, PNG, WEBP, and GIF are allowed.',
                ], 422);
            }

            // Double-check file size (security)
            if ($file->getSize() > self::MAX_FILE_SIZE) {
                return response()->json([
                    'success' => false,
                    'message' => 'File size exceeds the 20MB limit.',
                ], 422);
            }

            $originalSize = $file->getSize();
            $quality = (int) $validated['quality'];
            $outputFormat = $validated['format'] ?? 'original';

            // Sanitize filename
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName = Str::slug(Str::limit($originalName, 50, '')) ?: 'image';
            $uniqueId = Str::random(12);

            // Determine output extension
            if ($outputFormat === 'original') {
                $outputExt = self::MIME_TO_EXT[$mime] ?? 'jpg';
            } else {
                $outputExt = $outputFormat;
            }

            $outputFilename = "{$safeName}-compressed-{$uniqueId}.{$outputExt}";
            $outputPath = storage_path("app/public/uploads/{$outputFilename}");

            // Process image with Intervention Image
            $image = Image::read($file->getRealPath());

            // Encode with the target format and quality
            $encoded = $this->encodeImage($image, $outputExt, $quality);

            // Write to file
            file_put_contents($outputPath, (string) $encoded);
            $compressedSize = filesize($outputPath);

            // PNG guarantee: if compressed file is larger, apply aggressive optimization
            if ($compressedSize >= $originalSize) {
                $compressedSize = $this->optimizeForSmallerSize(
                    $image, $outputPath, $outputExt, $quality, $originalSize, $file->getRealPath()
                );
            }
            $reduction = $originalSize > 0
                ? round((1 - $compressedSize / $originalSize) * 100, 1)
                : 0;

            // Get image dimensions
            $dimensions = getimagesize($outputPath);

            // Save compression report
            try {
                CompressionReport::create([
                    'original_name'    => $file->getClientOriginalName(),
                    'original_format'  => self::MIME_TO_EXT[$mime] ?? 'unknown',
                    'output_format'    => $outputExt,
                    'original_size'    => $originalSize,
                    'compressed_size'  => $compressedSize,
                    'reduction_percent' => $reduction,
                    'quality'          => $quality,
                    'width'            => $dimensions[0] ?? null,
                    'height'           => $dimensions[1] ?? null,
                    'ip_address'       => $request->ip(),
                    'user_agent'       => Str::limit($request->userAgent(), 250),
                ]);
            } catch (\Throwable $e) {
                // Don't fail the request if report saving fails
                report($e);
            }

            return response()->json([
                'success'         => true,
                'original_size'   => $originalSize,
                'compressed_size' => $compressedSize,
                'reduction'       => $reduction,
                'download_url'    => route('image.download', ['filename' => $outputFilename]),
                'filename'        => $outputFilename,
                'original_name'   => $file->getClientOriginalName(),
                'format'          => strtoupper($outputExt),
                'width'           => $dimensions[0] ?? null,
                'height'          => $dimensions[1] ?? null,
                'formatted_original'   => $this->formatBytes($originalSize),
                'formatted_compressed' => $this->formatBytes($compressedSize),
            ]);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the image. Please try again.',
            ], 500);
        }
    }

    /**
     * Download a compressed image.
     */
    public function download(string $filename)
    {
        // Sanitize: only allow expected filename pattern
        if (!preg_match('/^[a-z0-9\-]+\.(jpg|jpeg|png|webp|gif)$/i', $filename)) {
            abort(404);
        }

        $path = storage_path("app/public/uploads/{$filename}");

        if (!file_exists($path)) {
            abort(404, 'File not found or has expired.');
        }

        return response()->download($path, $filename)->deleteFileAfterSend(false);
    }

    /**
     * Handle watermark-only application via AJAX (no compression).
     */
    public function applyWatermarkAction(Request $request): JsonResponse
    {
        ini_set('memory_limit', '512M');

        $key = 'watermark:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 30)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Too many requests. Please try again in {$seconds} seconds.",
            ], 429);
        }
        RateLimiter::hit($key, 60);

        $validated = $request->validate([
            'image'              => 'required|file|mimes:jpeg,jpg,png,webp,gif|max:20480',
            'watermark_text'     => 'required|string|max:100',
            'watermark_position' => 'required|string|in:center,top-left,top-right,bottom-left,bottom-right',
            'watermark_opacity'  => 'required|integer|min:10|max:100',
            'watermark_color'    => 'nullable|string|max:7',
            'output_format'      => 'nullable|string|in:original,jpg,png,webp',
        ]);

        try {
            $file = $request->file('image');

            $mime = $file->getMimeType();
            if (!in_array($mime, self::ALLOWED_MIMES, true)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid file type. Only JPG, PNG, WEBP, and GIF are allowed.',
                ], 422);
            }

            if ($file->getSize() > self::MAX_FILE_SIZE) {
                return response()->json([
                    'success' => false,
                    'message' => 'File size exceeds the 20MB limit.',
                ], 422);
            }

            $originalSize = $file->getSize();
            $watermarkText = trim($validated['watermark_text']);
            $watermarkPosition = $validated['watermark_position'];
            $watermarkOpacity = (int) $validated['watermark_opacity'];
            $watermarkColor = $validated['watermark_color'] ?? '#ffffff';
            $outputFormat = $validated['output_format'] ?? 'original';

            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName = Str::slug(Str::limit($originalName, 50, '')) ?: 'image';
            $uniqueId = Str::random(12);

            if ($outputFormat === 'original') {
                $outputExt = self::MIME_TO_EXT[$mime] ?? 'jpg';
            } else {
                $outputExt = $outputFormat;
            }

            $outputFilename = "{$safeName}-watermarked-{$uniqueId}.{$outputExt}";
            $outputPath = storage_path("app/public/uploads/{$outputFilename}");

            $image = Image::read($file->getRealPath());

            // Apply watermark
            $image = $this->applyWatermark($image, $watermarkText, $watermarkPosition, $watermarkOpacity, $watermarkColor);

            // Encode at high quality (preserve original quality, just add watermark)
            $encoded = $this->encodeImage($image, $outputExt, 90);
            file_put_contents($outputPath, (string) $encoded);
            $outputSize = filesize($outputPath);

            $dimensions = getimagesize($outputPath);

            // Save report
            try {
                CompressionReport::create([
                    'original_name'     => $file->getClientOriginalName(),
                    'original_format'   => self::MIME_TO_EXT[$mime] ?? 'unknown',
                    'output_format'     => $outputExt,
                    'original_size'     => $originalSize,
                    'compressed_size'   => $outputSize,
                    'reduction_percent' => $originalSize > 0 ? round((1 - $outputSize / $originalSize) * 100, 1) : 0,
                    'quality'           => 90,
                    'width'             => $dimensions[0] ?? null,
                    'height'            => $dimensions[1] ?? null,
                    'ip_address'        => $request->ip(),
                    'user_agent'        => Str::limit($request->userAgent(), 250),
                ]);
            } catch (\Throwable $e) {
                report($e);
            }

            return response()->json([
                'success'       => true,
                'original_size' => $originalSize,
                'output_size'   => $outputSize,
                'download_url'  => route('image.download', ['filename' => $outputFilename]),
                'filename'      => $outputFilename,
                'format'        => strtoupper($outputExt),
                'width'         => $dimensions[0] ?? null,
                'height'        => $dimensions[1] ?? null,
                'formatted_original' => $this->formatBytes($originalSize),
                'formatted_output'   => $this->formatBytes($outputSize),
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the image. Please try again.',
            ], 500);
        }
    }

    /**
     * Encode image with the target format and quality.
     * For PNG: uses indexed color reduction for real file size savings.
     */
    private function encodeImage($image, string $format, int $quality)
    {
        return match (strtolower($format)) {
            'jpg', 'jpeg' => $image->encode(new JpegEncoder(quality: $quality)),
            'png'         => $image->encode(new PngEncoder(interlaced: true, indexed: true)),
            'webp'        => $image->encode(new WebpEncoder(quality: $quality)),
            'gif'         => $image->encode(new GifEncoder()),
            default       => $image->encode(new JpegEncoder(quality: $quality)),
        };
    }

    /**
     * When the compressed file is STILL larger than the original,
     * apply progressively more aggressive optimization strategies.
     * Returns the final compressed file size.
     */
    private function optimizeForSmallerSize($image, string $outputPath, string $format, int $quality, int $originalSize, string $originalPath): int
    {
        // Strategy 1 (PNG): Try with indexed=true and scaled-down dimensions
        if (strtolower($format) === 'png') {
            // Try reducing dimensions slightly if image is large
            $width = $image->width();
            $height = $image->height();

            // Try encoding at progressively smaller scales
            $scales = [0.9, 0.8, 0.7];
            foreach ($scales as $scale) {
                $newW = (int) round($width * $scale);
                $newH = (int) round($height * $scale);
                if ($newW < 10 || $newH < 10) continue;

                $resized = Image::read($originalPath)->scale(width: $newW, height: $newH);
                $encoded = $resized->encode(new PngEncoder(interlaced: true, indexed: true));
                $data = (string) $encoded;

                if (strlen($data) < $originalSize) {
                    file_put_contents($outputPath, $data);
                    return strlen($data);
                }
            }

            // Strategy 2: Convert to JPEG internally at the quality level, write as PNG
            // This won't work for transparency. Instead, just copy original if all else fails.
        }

        // Strategy 3 (any format): If nothing worked, scale down slightly
        $width = $image->width();
        $height = $image->height();
        $resized = Image::read($originalPath)->scale(width: (int) round($width * 0.85), height: (int) round($height * 0.85));
        $encoded = $this->encodeImage($resized, $format, max(10, $quality - 10));
        $data = (string) $encoded;

        if (strlen($data) < $originalSize) {
            file_put_contents($outputPath, $data);
            return strlen($data);
        }

        // Final fallback: copy original file as-is (no increase)
        copy($originalPath, $outputPath);
        return $originalSize;
    }

    /**
     * Apply a text watermark on the image.
     */
    private function applyWatermark($image, string $text, string $position, int $opacity, string $color = '#ffffff')
    {
        $width = $image->width();
        $height = $image->height();

        // Scale font size based on image dimensions
        $fontSize = max(12, (int) round(min($width, $height) * 0.04));

        // Calculate position coordinates
        $padding = max(10, (int) round(min($width, $height) * 0.03));
        [$x, $y, $align, $valign] = $this->getWatermarkCoords($position, $width, $height, $padding);

        // Parse hex color (strip # if present)
        $hexColor = ltrim($color, '#');
        if (strlen($hexColor) !== 6) {
            $hexColor = 'ffffff';
        }

        // Calculate opacity for RGBA
        $alphaHex = dechex((int) round(255 * ($opacity / 100)));
        $alphaHex = str_pad($alphaHex, 2, '0', STR_PAD_LEFT);
        $colorWithAlpha = $hexColor . $alphaHex;

        // Draw text shadow first for readability
        $shadowAlpha = dechex((int) round(255 * ($opacity / 100) * 0.5));
        $shadowAlpha = str_pad($shadowAlpha, 2, '0', STR_PAD_LEFT);
        $shadowColor = '000000' . $shadowAlpha;

        $shadowOffset = max(1, (int) round($fontSize * 0.06));

        $image->text($text, $x + $shadowOffset, $y + $shadowOffset, function (FontFactory $font) use ($fontSize, $shadowColor, $align, $valign) {
            $font->size($fontSize);
            $font->color($shadowColor);
            $font->align($align);
            $font->valign($valign);
        });

        $image->text($text, $x, $y, function (FontFactory $font) use ($fontSize, $colorWithAlpha, $align, $valign) {
            $font->size($fontSize);
            $font->color($colorWithAlpha);
            $font->align($align);
            $font->valign($valign);
        });

        return $image;
    }

    /**
     * Get watermark X, Y, alignment from position name.
     */
    private function getWatermarkCoords(string $position, int $w, int $h, int $padding): array
    {
        return match ($position) {
            'top-left'     => [$padding, $padding, 'left', 'top'],
            'top-right'    => [$w - $padding, $padding, 'right', 'top'],
            'bottom-left'  => [$padding, $h - $padding, 'left', 'bottom'],
            'bottom-right' => [$w - $padding, $h - $padding, 'right', 'bottom'],
            'center'       => [(int) round($w / 2), (int) round($h / 2), 'center', 'middle'],
            default        => [$w - $padding, $h - $padding, 'right', 'bottom'],
        };
    }

    /**
     * Format bytes to human-readable string.
     */
    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $index = 0;
        $size = (float) $bytes;

        while ($size >= 1024 && $index < count($units) - 1) {
            $size /= 1024;
            $index++;
        }

        return round($size, $precision) . ' ' . $units[$index];
    }
}
