<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CompressionReport;

class PdfController extends Controller
{
    private const TEMP_DIR = 'app/temp-uploads';

    /**
     * Show Image to PDF page.
     */
    public function imageToPdf()
    {
        return view('image-to-pdf');
    }

    /**
     * Show PDF Compressor page.
     */
    public function pdfCompressor()
    {
        return view('pdf-compressor');
    }

    /**
     * Show Image Converter page.
     */
    public function imageConverter()
    {
        return view('image-converter');
    }

    /**
     * Upload a single file to temp storage.
     * Returns a token (filename) used later for merge/compress.
     */
    public function uploadTemp(Request $request): JsonResponse
    {
        $key = 'upload:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 60)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Too many uploads. Try again in {$seconds} seconds.",
            ], 429);
        }
        RateLimiter::hit($key, 60);

        $request->validate([
            'file' => 'required|file|max:20480', // 20MB per file
        ]);

        try {
            $file = $request->file('file');
            $mime = $file->getMimeType();

            // Allow images and PDFs
            $allowedMimes = [
                'image/jpeg', 'image/png', 'image/webp', 'image/gif',
                'application/pdf',
            ];
            if (!in_array($mime, $allowedMimes, true)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unsupported file type.',
                ], 422);
            }

            $tempDir = storage_path(self::TEMP_DIR);
            if (!is_dir($tempDir)) {
                mkdir($tempDir, 0755, true);
            }

            // Clean old temp files (>1 hour)
            $this->cleanTempFiles($tempDir, 3600);

            $ext = $file->getClientOriginalExtension() ?: 'bin';
            $token = Str::random(24) . '.' . strtolower($ext);
            $file->move($tempDir, $token);

            return response()->json([
                'success'  => true,
                'token'    => $token,
                'name'     => $file->getClientOriginalName(),
                'size'     => filesize($tempDir . '/' . $token),
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Convert previously uploaded images (by token) to PDF.
     */
    public function convertImagesToPdf(Request $request): JsonResponse
    {
        ini_set('memory_limit', '512M');
        set_time_limit(120);

        $key = 'img2pdf:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 20)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Too many requests. Try again in {$seconds} seconds.",
            ], 429);
        }
        RateLimiter::hit($key, 60);

        $request->validate([
            'tokens'      => 'required|array|min:1|max:20',
            'tokens.*'    => 'required|string|max:100',
            'orientation' => 'nullable|string|in:portrait,landscape',
            'page_size'   => 'nullable|string|in:a4,letter,a3,a5',
            'margin'      => 'nullable|integer|min:0|max:50',
            'fit_mode'    => 'nullable|string|in:fit,fill,stretch',
        ]);

        try {
            $tokens = $request->input('tokens');
            $orientation = $request->input('orientation', 'portrait');
            $pageSize = $request->input('page_size', 'a4');
            $margin = (int) $request->input('margin', 10);
            $fitMode = $request->input('fit_mode', 'fit');

            $tempDir = storage_path(self::TEMP_DIR);

            // Build image data array from tokens
            $imageData = [];
            $totalOriginalSize = 0;
            $processedFiles = []; // Track temp files we create for cleanup

            foreach ($tokens as $token) {
                // Sanitize token - only allow alphanumeric, dot
                if (!preg_match('/^[a-zA-Z0-9]+\.(jpg|jpeg|png|webp|gif)$/i', $token)) {
                    continue;
                }

                $filePath = $tempDir . '/' . $token;
                if (!file_exists($filePath)) {
                    continue;
                }

                $mime = mime_content_type($filePath);

                if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'])) {
                    continue;
                }

                $totalOriginalSize += filesize($filePath);

                // DomPDF supports JPEG and PNG natively.
                // WebP/GIF must be converted to PNG first.
                if (in_array($mime, ['image/webp', 'image/gif'])) {
                    $gdImage = @imagecreatefromstring(file_get_contents($filePath));
                    if (!$gdImage) {
                        continue;
                    }
                    imagesavealpha($gdImage, true);

                    $width = imagesx($gdImage);
                    $height = imagesy($gdImage);

                    $pngPath = $tempDir . '/' . Str::random(24) . '_proc.png';
                    imagepng($gdImage, $pngPath, 6);
                    imagedestroy($gdImage);
                    $processedFiles[] = $pngPath;

                    $imageData[] = [
                        'path'   => $pngPath,
                        'mime'   => 'image/png',
                        'width'  => $width,
                        'height' => $height,
                    ];
                } else {
                    // JPEG or PNG — use original file directly
                    $info = @getimagesize($filePath);
                    if (!$info) {
                        continue;
                    }

                    $imageData[] = [
                        'path'   => $filePath,
                        'mime'   => $mime,
                        'width'  => $info[0],
                        'height' => $info[1],
                    ];
                }
            }

            if (empty($imageData)) {
                // Clean up any processed files
                foreach ($processedFiles as $f) { @unlink($f); }
                return response()->json([
                    'success' => false,
                    'message' => 'No valid images found. Files may have expired.',
                ], 422);
            }

            // Page dimensions in mm
            $pageDimensions = [
                'a3'     => ['w' => 297, 'h' => 420],
                'a4'     => ['w' => 210, 'h' => 297],
                'a5'     => ['w' => 148, 'h' => 210],
                'letter' => ['w' => 216, 'h' => 279],
            ];

            $pageDim = $pageDimensions[$pageSize] ?? $pageDimensions['a4'];
            if ($orientation === 'landscape') {
                [$pageDim['w'], $pageDim['h']] = [$pageDim['h'], $pageDim['w']];
            }

            // DomPDF renders at configurable DPI (default 96). Convert mm → px at 96 DPI.
            $dpi = 96;
            $mmToPx = $dpi / 25.4;
            $contentWidthPx  = round(($pageDim['w'] - 2 * $margin) * $mmToPx);
            $contentHeightPx = round(($pageDim['h'] - 2 * $margin) * $mmToPx);

            // Generate HTML for PDF — use @page CSS for margins (in mm for simplicity)
            $html = '<html><head><style>';
            $html .= '@page { margin: ' . $margin . 'mm; }';
            $html .= 'body { margin: 0; padding: 0; }';
            $html .= '.page { width: 100%; text-align: center; page-break-after: always; }';
            $html .= '.page:last-child { page-break-after: auto; }';
            $html .= '.page img { display: block; margin: 0 auto; }';
            $html .= '</style></head><body>';

            foreach ($imageData as $img) {
                $imgW = $img['width'];
                $imgH = $img['height'];

                // Build base64 data URI from processed PNG file
                $pngContent = file_get_contents($img['path']);
                $base64 = base64_encode($pngContent);
                $src = "data:{$img['mime']};base64,{$base64}";

                if ($fitMode === 'stretch') {
                    $cssW = $contentWidthPx;
                    $cssH = $contentHeightPx;
                } elseif ($fitMode === 'fill') {
                    $ratioW = $contentWidthPx / $imgW;
                    $ratioH = $contentHeightPx / $imgH;
                    $ratio = max($ratioW, $ratioH);
                    $cssW = min(round($imgW * $ratio), $contentWidthPx);
                    $cssH = min(round($imgH * $ratio), $contentHeightPx);
                } else {
                    // "fit" mode — scale down to fit, never scale up
                    $ratioW = $contentWidthPx / $imgW;
                    $ratioH = $contentHeightPx / $imgH;
                    $ratio = min($ratioW, $ratioH, 1);
                    $cssW = round($imgW * $ratio);
                    $cssH = round($imgH * $ratio);
                }

                $html .= '<div class="page">';
                $html .= '<img src="' . $src . '" width="' . $cssW . '" height="' . $cssH . '">';
                $html .= '</div>';
            }

            $html .= '</body></html>';

            $pdf = Pdf::loadHTML($html)
                ->setPaper($pageSize, $orientation)
                ->setOption('isRemoteEnabled', true)
                ->setOption('isHtml5ParserEnabled', true);

            $uniqueId = Str::random(12);
            $outputFilename = "images-to-pdf-{$uniqueId}.pdf";
            $outputPath = storage_path("app/public/uploads/{$outputFilename}");

            if (!is_dir(dirname($outputPath))) {
                mkdir(dirname($outputPath), 0755, true);
            }

            file_put_contents($outputPath, $pdf->output());
            $pdfSize = filesize($outputPath);

            // Clean up temp files (original uploads)
            foreach ($tokens as $token) {
                $f = $tempDir . '/' . basename($token);
                if (file_exists($f)) {
                    @unlink($f);
                }
            }
            // Clean up processed PNG files
            foreach ($processedFiles as $f) {
                if (file_exists($f)) {
                    @unlink($f);
                }
            }

            // Save report
            try {
                CompressionReport::create([
                    'original_name'     => count($imageData) . ' images → PDF',
                    'original_format'   => 'images',
                    'output_format'     => 'pdf',
                    'original_size'     => $totalOriginalSize,
                    'compressed_size'   => $pdfSize,
                    'reduction_percent' => 0,
                    'quality'           => 100,
                    'width'             => null,
                    'height'            => null,
                    'ip_address'        => $request->ip(),
                    'user_agent'        => Str::limit($request->userAgent(), 250),
                ]);
            } catch (\Throwable $e) {
                report($e);
            }

            return response()->json([
                'success'       => true,
                'download_url'  => route('image.download', ['filename' => $outputFilename]),
                'filename'      => $outputFilename,
                'file_size'     => $pdfSize,
                'formatted_size' => $this->formatBytes($pdfSize),
                'page_count'    => count($imageData),
                'image_count'   => count($imageData),
                'total_original_size' => $totalOriginalSize,
                'formatted_original'  => $this->formatBytes($totalOriginalSize),
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Failed to create PDF. Please try again. Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Compress a PDF file from temp upload token.
     */
    public function compressPdf(Request $request): JsonResponse
    {
        ini_set('memory_limit', '512M');
        set_time_limit(120);

        $key = 'pdfcompress:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 20)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Too many requests. Try again in {$seconds} seconds.",
            ], 429);
        }
        RateLimiter::hit($key, 60);

        $request->validate([
            'token'   => 'required|string|max:100',
            'name'    => 'nullable|string|max:255',
            'quality' => 'nullable|string|in:low,medium,high',
        ]);

        try {
            $token = $request->input('token');
            $quality = $request->input('quality', 'medium');
            $originalName = $request->input('name', 'document.pdf');

            // Sanitize token
            if (!preg_match('/^[a-zA-Z0-9]+\.pdf$/i', $token)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid file token.',
                ], 422);
            }

            $tempDir = storage_path(self::TEMP_DIR);
            $inputPath = $tempDir . '/' . $token;

            if (!file_exists($inputPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File not found or expired. Please re-upload.',
                ], 422);
            }

            $originalSize = filesize($inputPath);

            $uniqueId = Str::random(12);
            $safeName = Str::slug(Str::limit(pathinfo($originalName, PATHINFO_FILENAME), 50, '')) ?: 'document';

            $gsPath = $this->findGhostscript();
            $outputFilename = "{$safeName}-compressed-{$uniqueId}.pdf";
            $outputPath = storage_path("app/public/uploads/{$outputFilename}");

            if (!is_dir(dirname($outputPath))) {
                mkdir(dirname($outputPath), 0755, true);
            }

            if ($gsPath) {
                $gsQuality = match ($quality) {
                    'low'    => '/screen',
                    'medium' => '/ebook',
                    'high'   => '/printer',
                    default  => '/ebook',
                };

                $cmd = escapeshellcmd($gsPath)
                    . ' -sDEVICE=pdfwrite'
                    . ' -dCompatibilityLevel=1.4'
                    . ' -dPDFSETTINGS=' . $gsQuality
                    . ' -dNOPAUSE -dBATCH -dQUIET'
                    . ' -sOutputFile=' . escapeshellarg($outputPath)
                    . ' ' . escapeshellarg($inputPath);

                exec($cmd . ' 2>&1', $output, $exitCode);

                if ($exitCode !== 0 || !file_exists($outputPath) || filesize($outputPath) === 0) {
                    copy($inputPath, $outputPath);
                }
            } else {
                copy($inputPath, $outputPath);
            }

            $compressedSize = filesize($outputPath);

            if ($compressedSize >= $originalSize) {
                copy($inputPath, $outputPath);
                $compressedSize = $originalSize;
            }

            $reduction = $originalSize > 0
                ? round((1 - $compressedSize / $originalSize) * 100, 1)
                : 0;

            // Clean up temp file
            @unlink($inputPath);

            // Save report
            try {
                CompressionReport::create([
                    'original_name'     => $originalName,
                    'original_format'   => 'pdf',
                    'output_format'     => 'pdf',
                    'original_size'     => $originalSize,
                    'compressed_size'   => $compressedSize,
                    'reduction_percent' => $reduction,
                    'quality'           => $quality === 'low' ? 30 : ($quality === 'medium' ? 60 : 90),
                    'width'             => null,
                    'height'            => null,
                    'ip_address'        => $request->ip(),
                    'user_agent'        => Str::limit($request->userAgent(), 250),
                ]);
            } catch (\Throwable $e) {
                report($e);
            }

            return response()->json([
                'success'              => true,
                'original_size'        => $originalSize,
                'compressed_size'      => $compressedSize,
                'reduction'            => $reduction,
                'download_url'         => route('image.download', ['filename' => $outputFilename]),
                'filename'             => $outputFilename,
                'original_name'        => $originalName,
                'formatted_original'   => $this->formatBytes($originalSize),
                'formatted_compressed' => $this->formatBytes($compressedSize),
                'has_ghostscript'      => $gsPath !== null,
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Failed to compress PDF. ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Find Ghostscript binary path.
     */
    private function findGhostscript(): ?string
    {
        $paths = ['gs', '/usr/bin/gs', '/usr/local/bin/gs', '/opt/homebrew/bin/gs'];
        foreach ($paths as $path) {
            exec("which {$path} 2>/dev/null", $output, $code);
            if ($code === 0 && !empty($output)) {
                return trim($output[0]);
            }
            $output = [];
        }
        // Try direct
        exec('gs --version 2>/dev/null', $output, $code);
        if ($code === 0) return 'gs';
        return null;
    }

    /**
     * Format bytes.
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

    /**
     * Clean temp files older than $maxAge seconds.
     */
    private function cleanTempFiles(string $dir, int $maxAge = 3600): void
    {
        if (!is_dir($dir)) return;

        $now = time();
        foreach (glob($dir . '/*') as $file) {
            if (is_file($file) && ($now - filemtime($file)) > $maxAge) {
                @unlink($file);
            }
        }
    }
}
