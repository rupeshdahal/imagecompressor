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
     * Convert images to PDF.
     */
    public function convertImagesToPdf(Request $request): JsonResponse
    {
        ini_set('memory_limit', '512M');
        set_time_limit(120);

        // Rate limiting
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
            'images'      => 'required|array|min:1|max:20',
            'images.*'    => 'required|file|mimes:jpeg,jpg,png,webp,gif|max:20480',
            'orientation' => 'nullable|string|in:portrait,landscape',
            'page_size'   => 'nullable|string|in:a4,letter,a3,a5',
            'margin'      => 'nullable|integer|min:0|max:50',
            'fit_mode'    => 'nullable|string|in:fit,fill,stretch',
        ]);

        try {
            $files = $request->file('images');
            $orientation = $request->input('orientation', 'portrait');
            $pageSize = $request->input('page_size', 'a4');
            $margin = (int) $request->input('margin', 10);
            $fitMode = $request->input('fit_mode', 'fit');

            // Build image data array
            $imageData = [];
            $totalOriginalSize = 0;

            foreach ($files as $file) {
                $mime = $file->getMimeType();
                if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'])) {
                    continue;
                }

                $totalOriginalSize += $file->getSize();
                $content = file_get_contents($file->getRealPath());

                // Convert webp/gif to png for PDF compatibility
                if (in_array($mime, ['image/webp', 'image/gif'])) {
                    $img = imagecreatefromstring($content);
                    if ($img) {
                        ob_start();
                        imagepng($img, null, 6);
                        $content = ob_get_clean();
                        imagedestroy($img);
                        $mime = 'image/png';
                    }
                }

                $base64 = base64_encode($content);
                $src = "data:{$mime};base64,{$base64}";

                // Get dimensions
                $info = getimagesizefromstring($content);
                $width = $info ? $info[0] : 800;
                $height = $info ? $info[1] : 600;

                $imageData[] = [
                    'src'    => $src,
                    'width'  => $width,
                    'height' => $height,
                    'name'   => $file->getClientOriginalName(),
                ];
            }

            if (empty($imageData)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No valid images found.',
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

            // Convert mm to approx px for CSS (96 DPI)
            $pageWidthPx  = round(($pageDim['w'] - 2 * $margin) * 3.7795);
            $pageHeightPx = round(($pageDim['h'] - 2 * $margin) * 3.7795);

            // Generate HTML for PDF
            $html = '<html><head><style>';
            $html .= 'body { margin: 0; padding: 0; }';
            $html .= '.page { width: 100%; text-align: center; page-break-after: always; }';
            $html .= '.page:last-child { page-break-after: auto; }';
            $html .= '.page img { display: block; margin: 0 auto; }';
            $html .= '</style></head><body>';

            foreach ($imageData as $img) {
                $imgW = $img['width'];
                $imgH = $img['height'];

                // Calculate size based on fit mode
                if ($fitMode === 'stretch') {
                    $cssW = $pageWidthPx;
                    $cssH = $pageHeightPx;
                } elseif ($fitMode === 'fill') {
                    $ratioW = $pageWidthPx / $imgW;
                    $ratioH = $pageHeightPx / $imgH;
                    $ratio = max($ratioW, $ratioH);
                    $cssW = min(round($imgW * $ratio), $pageWidthPx);
                    $cssH = min(round($imgH * $ratio), $pageHeightPx);
                } else {
                    // fit (contain)
                    $ratioW = $pageWidthPx / $imgW;
                    $ratioH = $pageHeightPx / $imgH;
                    $ratio = min($ratioW, $ratioH, 1); // Don't upscale
                    $cssW = round($imgW * $ratio);
                    $cssH = round($imgH * $ratio);
                }

                $html .= '<div class="page">';
                $html .= '<img src="' . $img['src'] . '" width="' . $cssW . '" height="' . $cssH . '">';
                $html .= '</div>';
            }

            $html .= '</body></html>';

            // Generate PDF
            $pdf = Pdf::loadHTML($html)
                ->setPaper($pageSize, $orientation)
                ->setOption('margin-top', $margin)
                ->setOption('margin-bottom', $margin)
                ->setOption('margin-left', $margin)
                ->setOption('margin-right', $margin)
                ->setOption('isRemoteEnabled', true);

            $uniqueId = Str::random(12);
            $outputFilename = "images-to-pdf-{$uniqueId}.pdf";
            $outputPath = storage_path("app/public/uploads/{$outputFilename}");

            // Ensure directory exists
            if (!is_dir(dirname($outputPath))) {
                mkdir(dirname($outputPath), 0755, true);
            }

            file_put_contents($outputPath, $pdf->output());
            $pdfSize = filesize($outputPath);

            // Save report
            try {
                CompressionReport::create([
                    'original_name'     => count($files) . ' images → PDF',
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
     * Compress a PDF file by re-rendering it.
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
            'pdf'     => 'required|file|mimes:pdf|max:51200', // 50MB
            'quality' => 'nullable|string|in:low,medium,high',
        ]);

        try {
            $file = $request->file('pdf');
            $originalSize = $file->getSize();
            $quality = $request->input('quality', 'medium');

            $uniqueId = Str::random(12);
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName = Str::slug(Str::limit($originalName, 50, '')) ?: 'document';

            // Use Ghostscript if available for real compression
            $gsPath = $this->findGhostscript();
            $outputFilename = "{$safeName}-compressed-{$uniqueId}.pdf";
            $outputPath = storage_path("app/public/uploads/{$outputFilename}");
            $inputPath = $file->getRealPath();

            if (!is_dir(dirname($outputPath))) {
                mkdir(dirname($outputPath), 0755, true);
            }

            if ($gsPath) {
                // Ghostscript compression levels
                $gsQuality = match ($quality) {
                    'low'    => '/screen',    // 72 DPI - maximum compression
                    'medium' => '/ebook',     // 150 DPI - balanced
                    'high'   => '/printer',   // 300 DPI - high quality
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
                    // Ghostscript failed, copy original
                    copy($inputPath, $outputPath);
                }
            } else {
                // No Ghostscript - just copy the file (inform user)
                copy($inputPath, $outputPath);
            }

            $compressedSize = filesize($outputPath);

            // If compressed is larger, use original
            if ($compressedSize >= $originalSize) {
                copy($inputPath, $outputPath);
                $compressedSize = $originalSize;
            }

            $reduction = $originalSize > 0
                ? round((1 - $compressedSize / $originalSize) * 100, 1)
                : 0;

            // Save report
            try {
                CompressionReport::create([
                    'original_name'     => $file->getClientOriginalName(),
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
                'original_name'        => $file->getClientOriginalName(),
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
}
