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
use App\Models\CompressionReport;

class ImageController extends Controller
{
    /**
     * Maximum file size in bytes (10MB).
     */
    private const MAX_FILE_SIZE = 10 * 1024 * 1024;

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
     * Show the home page.
     */
    public function index()
    {
        return view('home');
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
            'image'   => 'required|file|mimes:jpeg,jpg,png,webp,gif|max:20480', // 20MB = 20480 KB
            'quality' => 'required|integer|min:10|max:90',
            'format'  => 'nullable|string|in:original,jpg,png,webp',
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
                    'message' => 'File size exceeds the 10MB limit.',
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
            $encoder = $this->getEncoder($outputExt, $quality);
            $encoded = $image->encode($encoder);

            // Write to file
            file_put_contents($outputPath, (string) $encoded);
            
            $compressedSize = filesize($outputPath);

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
                'original_size'   => $this->formatBytes($originalSize),
                'compressed_size' => $this->formatBytes($compressedSize),
                'original_size_bytes'   => $originalSize,
                'compressed_size_bytes' => $compressedSize,
                'reduction'       => $reduction,
                'download_url'    => route('image.download', ['filename' => $outputFilename]),
                'preview_url'     => asset('storage/uploads/' . $outputFilename),
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
        if (!preg_match('/^[a-z0-9\-]+\.(jpg|jpeg|png|webp|gif|pdf)$/i', $filename)) {
            abort(404);
        }

        $path = storage_path("app/public/uploads/{$filename}");

        if (!file_exists($path)) {
            abort(404, 'File not found or has expired.');
        }

        return response()->download($path, $filename)->deleteFileAfterSend(false);
    }

    /**
     * Get the appropriate encoder for the target format.
     */
    private function getEncoder(string $format, int $quality)
    {
        return match (strtolower($format)) {
            'jpg', 'jpeg' => new JpegEncoder(quality: $quality),
            'png'         => new PngEncoder(), // PNG is lossless, no quality parameter
            'webp'        => new WebpEncoder(quality: $quality),
            'gif'         => new GifEncoder(),
            default       => new JpegEncoder(quality: $quality),
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
