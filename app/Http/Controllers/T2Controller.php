<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Encoders\GifEncoder;
use App\Models\CompressionReport;
use ZipArchive;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * T2Controller — handles all Sprint 2 features:
 *  - Batch compress + ZIP download
 *  - Image resize
 *  - Image → PDF
 *  - PDF → Image
 *  - Watermark
 *  - URL-based compression
 */
class T2Controller extends Controller
{
    /** Max file size: 20 MB */
    private const MAX_FILE_SIZE = 20 * 1024 * 1024;

    /** Max batch count */
    private const MAX_BATCH = 20;

    /** Allowed MIME types for image input */
    private const ALLOWED_MIMES = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
    ];

    private const MIME_TO_EXT = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
        'image/gif'  => 'gif',
    ];

    // ─────────────────────────────────────────────────────────────────
    // T2-1: Batch Compress
    // ─────────────────────────────────────────────────────────────────

    /**
     * Compress multiple images in one request.
     * Returns an array of per-file results.
     */
    public function compressBatch(Request $request): JsonResponse
    {
        ini_set('memory_limit', '512M');

        $key = 'batch:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 10)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Too many requests. Try again in {$seconds} seconds.",
            ], 429);
        }
        RateLimiter::hit($key, 60);

        $request->validate([
            'images'   => 'required|array|min:1|max:' . self::MAX_BATCH,
            'images.*' => 'required|file|mimes:jpeg,jpg,png,webp,gif|max:20480',
            'quality'  => 'nullable|integer|min:10|max:90',
            'format'   => 'nullable|string|in:original,jpg,png,webp',
        ]);

        $quality      = (int) ($request->input('quality', 50));
        $outputFormat = $request->input('format', 'original');
        $batchId      = Str::uuid()->toString();
        $results      = [];

        foreach ($request->file('images') as $file) {
            try {
                $mime = $file->getMimeType();
                if (!in_array($mime, self::ALLOWED_MIMES, true)) {
                    $results[] = [
                        'success'       => false,
                        'original_name' => $file->getClientOriginalName(),
                        'message'       => 'Invalid file type.',
                    ];
                    continue;
                }

                if ($file->getSize() > self::MAX_FILE_SIZE) {
                    $results[] = [
                        'success'       => false,
                        'original_name' => $file->getClientOriginalName(),
                        'message'       => 'File exceeds 20MB limit.',
                    ];
                    continue;
                }

                $originalSize = $file->getSize();
                $origName     = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeName     = Str::slug(Str::limit($origName, 40, '')) ?: 'image';
                $uniqueId     = Str::random(6);

                $outputExt = ($outputFormat === 'original')
                    ? (self::MIME_TO_EXT[$mime] ?? 'jpg')
                    : $outputFormat;

                $outputFilename = "compresslypro-{$safeName}-{$uniqueId}.{$outputExt}";
                $outputPath     = storage_path("app/public/uploads/{$outputFilename}");

                $image   = Image::read($file->getRealPath());
                $encoder = $this->getEncoder($outputExt, $quality);
                $encoded = $image->encode($encoder);
                file_put_contents($outputPath, (string) $encoded);

                $compressedSize = filesize($outputPath);
                $reduction      = $originalSize > 0
                    ? round((1 - $compressedSize / $originalSize) * 100, 1) : 0;
                $dimensions     = getimagesize($outputPath);

                try {
                    CompressionReport::create([
                        'action'            => 'batch',
                        'batch_id'          => $batchId,
                        'referrer'          => Str::limit($request->header('referer', ''), 500),
                        'original_name'     => $file->getClientOriginalName(),
                        'original_format'   => self::MIME_TO_EXT[$mime] ?? 'unknown',
                        'output_format'     => $outputExt,
                        'original_size'     => $originalSize,
                        'compressed_size'   => $compressedSize,
                        'reduction_percent' => $reduction,
                        'quality'           => $quality,
                        'width'             => $dimensions[0] ?? null,
                        'height'            => $dimensions[1] ?? null,
                        'ip_address'        => $request->ip(),
                        'user_agent'        => Str::limit($request->userAgent(), 250),
                    ]);
                } catch (\Throwable $e) { report($e); }

                $results[] = [
                    'success'              => true,
                    'original_name'        => $file->getClientOriginalName(),
                    'filename'             => $outputFilename,
                    'download_url'         => route('image.download', ['filename' => $outputFilename]),
                    'original_size'        => $originalSize,
                    'compressed_size'      => $compressedSize,
                    'reduction'            => $reduction,
                    'format'               => strtoupper($outputExt),
                    'width'                => $dimensions[0] ?? null,
                    'height'               => $dimensions[1] ?? null,
                    'formatted_original'   => $this->formatBytes($originalSize),
                    'formatted_compressed' => $this->formatBytes($compressedSize),
                ];
            } catch (\Throwable $e) {
                report($e);
                $results[] = [
                    'success'       => false,
                    'original_name' => $file->getClientOriginalName(),
                    'message'       => 'Processing failed.',
                ];
            }
        }

        $successResults = array_filter($results, fn($r) => $r['success'] ?? false);
        $filenames      = array_column(array_values($successResults), 'filename');

        return response()->json([
            'success'   => true,
            'batch_id'  => $batchId,
            'results'   => $results,
            'filenames' => $filenames,
            'total'     => count($results),
            'succeeded' => count($successResults),
            'failed'    => count($results) - count($successResults),
        ]);
    }

    /**
     * Download a batch of compressed files as a ZIP archive.
     */
    public function downloadBatchZip(Request $request)
    {
        $request->validate([
            'filenames'   => 'required|array|min:1|max:' . self::MAX_BATCH,
            'filenames.*' => [
                'required', 'string',
                'regex:/^compresslypro-[a-z0-9\-]+\.(jpg|jpeg|png|webp|gif)$/i',
            ],
        ]);

        $filenames = $request->input('filenames');
        $zipPath   = storage_path('app/temp-uploads/batch-' . Str::random(12) . '.zip');

        // Ensure temp dir exists
        @mkdir(dirname($zipPath), 0755, true);

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return response()->json(['success' => false, 'message' => 'Failed to create ZIP.'], 500);
        }

        $added = 0;
        foreach ($filenames as $filename) {
            $path = storage_path("app/public/uploads/{$filename}");
            if (file_exists($path)) {
                $zip->addFile($path, $filename);
                $added++;
            }
        }
        $zip->close();

        if ($added === 0) {
            @unlink($zipPath);
            return response()->json(['success' => false, 'message' => 'No valid files found.'], 404);
        }

        return response()->download($zipPath, 'compresslypro-batch.zip', [
            'Content-Type' => 'application/zip',
        ])->deleteFileAfterSend(true);
    }

    // ─────────────────────────────────────────────────────────────────
    // T2-2: Image Resize
    // ─────────────────────────────────────────────────────────────────

    /**
     * Resize an image.
     * Modes: exact (w×h), percentage, max_width, max_height
     */
    public function resize(Request $request): JsonResponse
    {
        ini_set('memory_limit', '512M');

        $key = 'resize:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 30)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Too many requests. Try again in {$seconds} seconds.",
            ], 429);
        }
        RateLimiter::hit($key, 60);

        $request->validate([
            'image'      => 'required|file|mimes:jpeg,jpg,png,webp,gif|max:20480',
            'mode'       => 'required|string|in:exact,percentage,max_width,max_height',
            'width'      => 'nullable|integer|min:1|max:8000',
            'height'     => 'nullable|integer|min:1|max:8000',
            'percentage' => 'nullable|integer|min:1|max:200',
            'quality'    => 'nullable|integer|min:10|max:100',
            'format'     => 'nullable|string|in:original,jpg,png,webp',
        ]);

        try {
            $file = $request->file('image');
            $mime = $file->getMimeType();

            if (!in_array($mime, self::ALLOWED_MIMES, true)) {
                return response()->json(['success' => false, 'message' => 'Invalid file type.'], 422);
            }

            $originalSize = $file->getSize();
            $mode         = $request->input('mode');
            $quality      = (int) ($request->input('quality', 85));
            $outputFormat = $request->input('format', 'original');
            $outputExt    = ($outputFormat === 'original')
                ? (self::MIME_TO_EXT[$mime] ?? 'jpg')
                : $outputFormat;

            $origName   = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName   = Str::slug(Str::limit($origName, 40, '')) ?: 'image';
            $uniqueId   = Str::random(8);
            $outputFilename = "compresslypro-{$safeName}-{$uniqueId}.{$outputExt}";
            $outputPath     = storage_path("app/public/uploads/{$outputFilename}");

            $image = Image::read($file->getRealPath());

            switch ($mode) {
                case 'exact':
                    $w = (int) $request->input('width', $image->width());
                    $h = (int) $request->input('height', $image->height());
                    $image->resize($w, $h);
                    break;

                case 'percentage':
                    $pct  = (int) $request->input('percentage', 50);
                    $newW = (int) round($image->width() * $pct / 100);
                    $newH = (int) round($image->height() * $pct / 100);
                    $image->resize($newW, $newH);
                    break;

                case 'max_width':
                    $maxW = (int) $request->input('width', 1920);
                    if ($image->width() > $maxW) {
                        $image->scaleDown($maxW, null);
                    }
                    break;

                case 'max_height':
                    $maxH = (int) $request->input('height', 1080);
                    if ($image->height() > $maxH) {
                        $image->scaleDown(null, $maxH);
                    }
                    break;
            }

            $encoder = $this->getEncoder($outputExt, $quality);
            $encoded = $image->encode($encoder);
            file_put_contents($outputPath, (string) $encoded);

            $compressedSize = filesize($outputPath);
            $reduction      = $originalSize > 0
                ? round((1 - $compressedSize / $originalSize) * 100, 1) : 0;
            $dimensions     = getimagesize($outputPath);

            try {
                CompressionReport::create([
                    'action'            => 'resize',
                    'referrer'          => Str::limit($request->header('referer', ''), 500),
                    'original_name'     => $file->getClientOriginalName(),
                    'original_format'   => self::MIME_TO_EXT[$mime] ?? 'unknown',
                    'output_format'     => $outputExt,
                    'original_size'     => $originalSize,
                    'compressed_size'   => $compressedSize,
                    'reduction_percent' => $reduction,
                    'quality'           => $quality,
                    'width'             => $dimensions[0] ?? null,
                    'height'            => $dimensions[1] ?? null,
                    'ip_address'        => $request->ip(),
                    'user_agent'        => Str::limit($request->userAgent(), 250),
                ]);
            } catch (\Throwable $e) { report($e); }

            return response()->json([
                'success'              => true,
                'original_name'        => $file->getClientOriginalName(),
                'filename'             => $outputFilename,
                'download_url'         => route('image.download', ['filename' => $outputFilename]),
                'original_size'        => $originalSize,
                'resized_size'         => $compressedSize,
                'reduction'            => $reduction,
                'format'               => strtoupper($outputExt),
                'width'                => $dimensions[0] ?? null,
                'height'               => $dimensions[1] ?? null,
                'formatted_original'   => $this->formatBytes($originalSize),
                'formatted_resized'    => $this->formatBytes($compressedSize),
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while resizing. Please try again.',
            ], 500);
        }
    }

    // ─────────────────────────────────────────────────────────────────
    // T2-3: Image → PDF
    // ─────────────────────────────────────────────────────────────────

    /**
     * Convert an image to a PDF file using DomPDF.
     */
    public function imageToPdf(Request $request)
    {
        ini_set('memory_limit', '512M');

        $key = 'img2pdf:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 15)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Too many requests. Try again in {$seconds} seconds.",
            ], 429);
        }
        RateLimiter::hit($key, 60);

        $request->validate([
            'image'       => 'required|file|mimes:jpeg,jpg,png,webp,gif|max:20480',
            'page_size'   => 'nullable|string|in:A4,A3,Letter,Legal',
            'orientation' => 'nullable|string|in:portrait,landscape',
            'margin'      => 'nullable|integer|min:0|max:50',
        ]);

        try {
            $file        = $request->file('image');
            $mime        = $file->getMimeType();
            $pageSize    = $request->input('page_size', 'A4');
            $orientation = $request->input('orientation', 'portrait');
            $margin      = (int) $request->input('margin', 10);

            if (!in_array($mime, self::ALLOWED_MIMES, true)) {
                return response()->json(['success' => false, 'message' => 'Invalid file type.'], 422);
            }

            // Convert image to PNG for reliable embedding in DomPDF
            $imgObj = Image::read($file->getRealPath());
            $pngData = base64_encode((string) $imgObj->encode(new PngEncoder()));
            $imgW    = $imgObj->width();
            $imgH    = $imgObj->height();

            // Calculate page dimensions
            $pageDims = [
                'A4'     => ['portrait' => [210, 297], 'landscape' => [297, 210]],
                'A3'     => ['portrait' => [297, 420], 'landscape' => [420, 297]],
                'Letter' => ['portrait' => [216, 279], 'landscape' => [279, 216]],
                'Legal'  => ['portrait' => [216, 356], 'landscape' => [356, 216]],
            ];
            [$pW, $pH] = $pageDims[$pageSize][$orientation];

            // Max image area (mm minus margins)
            $availW = $pW - ($margin * 2);
            $availH = $pH - ($margin * 2);
            $ratio  = $imgH / max($imgW, 1);

            // Scale to fit available area while preserving aspect ratio
            if ($imgW / $imgH > $availW / $availH) {
                $dispW = $availW;
                $dispH = round($availW * $ratio);
            } else {
                $dispH = $availH;
                $dispW = round($availH / $ratio);
            }

            $html = '<!DOCTYPE html>
<html><head>
<meta charset="UTF-8">
<style>
  * { margin:0; padding:0; box-sizing:border-box; }
  body { background:#fff; }
  .page { width:100%; padding:' . $margin . 'mm; display:flex; align-items:center; justify-content:center; min-height:' . ($pH - $margin * 2) . 'mm; }
  img { max-width:' . $dispW . 'mm; max-height:' . $dispH . 'mm; display:block; }
</style>
</head><body>
<div class="page"><img src="data:image/png;base64,' . $pngData . '"></div>
</body></html>';

            $pdf = Pdf::loadHTML($html)
                ->setPaper(strtolower($pageSize), $orientation)
                ->setOptions([
                    'isPhpEnabled'     => false,
                    'isRemoteEnabled'  => false,
                    'isFontSubsettingEnabled' => true,
                    'defaultFont'      => 'sans-serif',
                    'dpi'              => 150,
                ]);

            $origName   = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName   = Str::slug(Str::limit($origName, 40, '')) ?: 'image';
            $uniqueId   = Str::random(8);
            $pdfFilename = "compresslypro-{$safeName}-{$uniqueId}.pdf";
            $pdfPath     = storage_path("app/public/uploads/{$pdfFilename}");

            file_put_contents($pdfPath, $pdf->output());
            $pdfSize = filesize($pdfPath);

            return response()->json([
                'success'       => true,
                'filename'      => $pdfFilename,
                'download_url'  => route('pdf.download', ['filename' => $pdfFilename]),
                'original_name' => $file->getClientOriginalName(),
                'size'          => $pdfSize,
                'pdf_size'      => $pdfSize,
                'formatted_size'=> $this->formatBytes($pdfSize),
                'page_size'     => $pageSize,
                'orientation'   => $orientation,
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Failed to convert image to PDF. Please try again.',
            ], 500);
        }
    }

    /**
     * Download a generated PDF file.
     */
    public function downloadPdf(string $filename)
    {
        if (!preg_match('/^compresslypro-[a-z0-9\-]+\.pdf$/i', $filename)) {
            abort(404);
        }
        $path = storage_path("app/public/uploads/{$filename}");
        if (!file_exists($path)) {
            abort(404, 'PDF not found or has expired.');
        }
        return response()->download($path, $filename)->deleteFileAfterSend(false);
    }

    // ─────────────────────────────────────────────────────────────────
    // T2-4: PDF → Image
    // ─────────────────────────────────────────────────────────────────

    /**
     * Convert a PDF file to images using Imagick.
     */
    public function pdfToImage(Request $request): JsonResponse
    {
        ini_set('memory_limit', '512M');

        $key = 'pdf2img:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 10)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Too many requests. Try again in {$seconds} seconds.",
            ], 429);
        }
        RateLimiter::hit($key, 60);

        $request->validate([
            'pdf'        => 'required|file|mimes:pdf|max:20480',
            'format'     => 'nullable|string|in:jpg,png,webp',
            'dpi'        => 'nullable|integer|min:72|max:300',
            'page'       => 'nullable|integer|min:0|max:99',
        ]);

        if (!extension_loaded('imagick')) {
            return response()->json([
                'success' => false,
                'message' => 'PDF conversion requires the Imagick extension.',
            ], 500);
        }

        try {
            $file      = $request->file('pdf');
            $format    = $request->input('format', 'jpg');
            $dpi       = (int) $request->input('dpi', 150);
            $page      = (int) $request->input('page', 0);

            $origName    = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName    = Str::slug(Str::limit($origName, 40, '')) ?: 'document';
            $uniqueId    = Str::random(8);

            $imagick = new \Imagick();
            $imagick->setResolution($dpi, $dpi);
            $imagick->readImage($file->getRealPath() . '[' . $page . ']');
            $imagick->setImageFormat($format === 'jpg' ? 'jpeg' : $format);
            $imagick->setImageCompressionQuality(85);
            $imagick->flattenImages();
            $imagick->mergeImageLayers(\Imagick::LAYERMETHOD_FLATTEN);
            // Set white background for JPEG
            if ($format === 'jpg') {
                $canvas = new \Imagick();
                $canvas->newImage($imagick->getImageWidth(), $imagick->getImageHeight(), new \ImagickPixel('white'));
                $canvas->compositeImage($imagick, \Imagick::COMPOSITE_OVER, 0, 0);
                $canvas->setImageFormat('jpeg');
                $canvas->setImageCompressionQuality(85);
                $imgData = $canvas->getImageBlob();
                $canvas->destroy();
            } else {
                $imgData = $imagick->getImageBlob();
            }
            $imagick->destroy();

            $outputFilename = "compresslypro-{$safeName}-{$uniqueId}.{$format}";
            $outputPath     = storage_path("app/public/uploads/{$outputFilename}");
            file_put_contents($outputPath, $imgData);

            $outputSize = filesize($outputPath);
            $dimensions = getimagesize($outputPath);

            return response()->json([
                'success'         => true,
                'filename'        => $outputFilename,
                'download_url'    => route('image.download', ['filename' => $outputFilename]),
                'original_name'   => $file->getClientOriginalName(),
                'output_size'     => $outputSize,
                'formatted_size'  => $this->formatBytes($outputSize),
                'format'          => strtoupper($format),
                'width'           => $dimensions[0] ?? null,
                'height'          => $dimensions[1] ?? null,
                'page'            => $page,
                'dpi'             => $dpi,
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Failed to convert PDF to image. Ensure the PDF is valid.',
            ], 500);
        }
    }

    // ─────────────────────────────────────────────────────────────────
    // T2-5: Watermark
    // ─────────────────────────────────────────────────────────────────

    /**
     * Add a text watermark to an image.
     */
    public function watermark(Request $request): JsonResponse
    {
        ini_set('memory_limit', '512M');

        $key = 'watermark:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 30)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Too many requests. Try again in {$seconds} seconds.",
            ], 429);
        }
        RateLimiter::hit($key, 60);

        $request->validate([
            'image'     => 'required|file|mimes:jpeg,jpg,png,webp,gif|max:20480',
            'text'      => 'required|string|min:1|max:100',
            'position'  => 'nullable|string|in:bottom-right,bottom-left,top-right,top-left,center',
            'opacity'   => 'nullable|integer|min:10|max:100',
            'size'      => 'nullable|integer|min:10|max:200',
            'color'     => 'nullable|string|regex:/^#?[0-9a-fA-F]{3,6}$/',
            'quality'   => 'nullable|integer|min:10|max:90',
            'format'    => 'nullable|string|in:original,jpg,png,webp',
        ]);

        try {
            $file     = $request->file('image');
            $mime     = $file->getMimeType();

            if (!in_array($mime, self::ALLOWED_MIMES, true)) {
                return response()->json(['success' => false, 'message' => 'Invalid file type.'], 422);
            }

            $text     = $request->input('text');
            $position = $request->input('position', 'bottom-right');
            $opacity  = (int) $request->input('opacity', 60);
            $fontSize = (int) $request->input('size', 24);
            $colorHex = ltrim($request->input('color', 'ffffff'), '#');
            $quality  = (int) $request->input('quality', 80);
            $outputFormat = $request->input('format', 'original');

            $outputExt = ($outputFormat === 'original')
                ? (self::MIME_TO_EXT[$mime] ?? 'jpg')
                : $outputFormat;

            $origName   = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName   = Str::slug(Str::limit($origName, 40, '')) ?: 'image';
            $uniqueId   = Str::random(8);
            $outputFilename = "compresslypro-{$safeName}-{$uniqueId}.{$outputExt}";
            $outputPath     = storage_path("app/public/uploads/{$outputFilename}");
            $originalSize   = $file->getSize();

            // Use Imagick for watermark text rendering
            if (extension_loaded('imagick')) {
                try {
                    $imagick = new \Imagick($file->getRealPath());
                    // Flatten for JPEG
                    if ($outputExt === 'jpg') {
                        $bg = new \Imagick();
                        $bg->newImage($imagick->getImageWidth(), $imagick->getImageHeight(), new \ImagickPixel('white'));
                        $bg->compositeImage($imagick, \Imagick::COMPOSITE_OVER, 0, 0);
                        $imagick->destroy();
                        $imagick = $bg;
                    }

                    $imgW = $imagick->getImageWidth();
                    $imgH = $imagick->getImageHeight();

                    $draw = new \ImagickDraw();
                    $draw->setFontSize($fontSize);
                    $draw->setFillOpacity($opacity / 100);
                    $draw->setFillColor(new \ImagickPixel('#' . $colorHex));

                    // Try to detect a system font
                    $systemFonts = $imagick->queryFonts('*');
                    if (!empty($systemFonts)) {
                        $draw->setFont($systemFonts[0]);
                    }

                    // Calculate padding
                    $pad = (int) ($fontSize * 0.5);
                    try {
                        $metrics = $imagick->queryFontMetrics($draw, $text);
                        $tw = (int) ($metrics['textWidth'] ?? $fontSize * strlen($text) * 0.6);
                        $th = (int) ($metrics['textHeight'] ?? $fontSize);
                    } catch (\Throwable $me) {
                        $tw = (int) ($fontSize * strlen($text) * 0.6);
                        $th = $fontSize;
                    }

                    [$x, $y] = match ($position) {
                        'bottom-right' => [$imgW - $tw - $pad, $imgH - $pad],
                        'bottom-left'  => [$pad, $imgH - $pad],
                        'top-right'    => [$imgW - $tw - $pad, $th + $pad],
                        'top-left'     => [$pad, $th + $pad],
                        'center'       => [(int)(($imgW - $tw) / 2), (int)(($imgH + $th) / 2)],
                        default        => [$imgW - $tw - $pad, $imgH - $pad],
                    };

                    $imagick->annotateImage($draw, $x, $y, 0, $text);

                    $imagick->setImageFormat($outputExt === 'jpg' ? 'jpeg' : $outputExt);
                    $imagick->setImageCompressionQuality($quality);
                    file_put_contents($outputPath, $imagick->getImageBlob());
                    $imagick->destroy();
                } catch (\Throwable $imagickErr) {
                    // Imagick failed (e.g. no fonts) — fall through to GD
                    $this->applyWatermarkWithGd($file->getRealPath(), $outputPath, $outputExt, $text, $position, $opacity, $quality);
                }
            } else {
                $this->applyWatermarkWithGd($file->getRealPath(), $outputPath, $outputExt, $text, $position, $opacity, $quality);
            }

            $compressedSize = filesize($outputPath);
            $dimensions     = getimagesize($outputPath);
            $reduction      = $originalSize > 0
                ? round((1 - $compressedSize / $originalSize) * 100, 1) : 0;

            try {
                CompressionReport::create([
                    'action'            => 'watermark',
                    'referrer'          => Str::limit($request->header('referer', ''), 500),
                    'original_name'     => $file->getClientOriginalName(),
                    'original_format'   => self::MIME_TO_EXT[$mime] ?? 'unknown',
                    'output_format'     => $outputExt,
                    'original_size'     => $originalSize,
                    'compressed_size'   => $compressedSize,
                    'reduction_percent' => $reduction,
                    'quality'           => $quality,
                    'width'             => $dimensions[0] ?? null,
                    'height'            => $dimensions[1] ?? null,
                    'ip_address'        => $request->ip(),
                    'user_agent'        => Str::limit($request->userAgent(), 250),
                ]);
            } catch (\Throwable $e) { report($e); }

            return response()->json([
                'success'              => true,
                'original_name'        => $file->getClientOriginalName(),
                'filename'             => $outputFilename,
                'download_url'         => route('image.download', ['filename' => $outputFilename]),
                'original_size'        => $originalSize,
                'size'                 => $compressedSize,
                'output_size'          => $compressedSize,
                'format'               => strtoupper($outputExt),
                'width'                => $dimensions[0] ?? null,
                'height'               => $dimensions[1] ?? null,
                'formatted_original'   => $this->formatBytes($originalSize),
                'formatted_output'     => $this->formatBytes($compressedSize),
                'formatted_size'       => $this->formatBytes($compressedSize),
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Failed to apply watermark. Please try again.',
            ], 500);
        }
    }

    // ─────────────────────────────────────────────────────────────────
    // T2-6: URL-based Compression
    // ─────────────────────────────────────────────────────────────────

    /**
     * Compress an image fetched from a remote URL.
     * SSRF protection: block private/loopback IPs.
     */
    public function compressFromUrl(Request $request): JsonResponse
    {
        ini_set('memory_limit', '512M');

        $key = 'url_press:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 15)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => "Too many requests. Try again in {$seconds} seconds.",
            ], 429);
        }
        RateLimiter::hit($key, 60);

        $request->validate([
            'url'     => ['required', 'string', 'max:2048', 'url', 'regex:/^https?:\/\//i'],
            'quality' => 'nullable|integer|min:10|max:90',
            'format'  => 'nullable|string|in:original,jpg,png,webp',
        ]);

        $url     = $request->input('url');
        $quality = (int) $request->input('quality', 50);
        $outputFormat = $request->input('format', 'original');

        // SSRF protection: resolve host and block private/loopback IPs
        $host = parse_url($url, PHP_URL_HOST);
        if (!$host) {
            return response()->json(['success' => false, 'message' => 'Invalid URL.'], 422);
        }

        $ip = gethostbyname($host);
        if ($this->isPrivateIp($ip)) {
            return response()->json(['success' => false, 'message' => 'URL not allowed.'], 422);
        }

        // Only allow http/https (already validated by regex rule above, belt-and-suspenders)
        $scheme = strtolower(parse_url($url, PHP_URL_SCHEME) ?? '');
        if (!in_array($scheme, ['http', 'https'])) {
            return response()->json(['success' => false, 'message' => 'Only HTTP/HTTPS URLs are supported.'], 422);
        }

        try {
            // Fetch the remote image (max 20MB, 10s timeout)
            $context = stream_context_create([
                'http' => [
                    'timeout'          => 10,
                    'follow_location'  => true,
                    'max_redirects'    => 3,
                    'user_agent'       => 'CompresslyPro/1.0 Image Downloader',
                ],
                'https' => [
                    'timeout'          => 10,
                    'follow_location'  => true,
                    'max_redirects'    => 3,
                    'user_agent'       => 'CompresslyPro/1.0 Image Downloader',
                ],
            ]);

            $imageData = @file_get_contents($url, false, $context, 0, self::MAX_FILE_SIZE + 1);
            if ($imageData === false) {
                return response()->json(['success' => false, 'message' => 'Failed to download image from URL.'], 422);
            }

            if (strlen($imageData) > self::MAX_FILE_SIZE) {
                return response()->json(['success' => false, 'message' => 'Remote image exceeds the 20MB limit.'], 422);
            }

            // Validate MIME type of fetched data
            $tmpPath = tempnam(sys_get_temp_dir(), 'cp_url_');
            file_put_contents($tmpPath, $imageData);
            $mime = mime_content_type($tmpPath);

            if (!in_array($mime, self::ALLOWED_MIMES, true)) {
                @unlink($tmpPath);
                return response()->json(['success' => false, 'message' => 'URL does not point to a valid image.'], 422);
            }

            $originalSize = strlen($imageData);
            $outputExt    = ($outputFormat === 'original')
                ? (self::MIME_TO_EXT[$mime] ?? 'jpg')
                : $outputFormat;

            $urlBaseName = pathinfo(parse_url($url, PHP_URL_PATH) ?? 'image', PATHINFO_FILENAME);
            $safeName    = Str::slug(Str::limit($urlBaseName ?: 'image', 40, '')) ?: 'image';
            $uniqueId    = Str::random(8);
            $outputFilename = "compresslypro-{$safeName}-{$uniqueId}.{$outputExt}";
            $outputPath     = storage_path("app/public/uploads/{$outputFilename}");

            $image   = Image::read($tmpPath);
            $encoder = $this->getEncoder($outputExt, $quality);
            $encoded = $image->encode($encoder);
            file_put_contents($outputPath, (string) $encoded);
            @unlink($tmpPath);

            $compressedSize = filesize($outputPath);
            $reduction      = $originalSize > 0
                ? round((1 - $compressedSize / $originalSize) * 100, 1) : 0;
            $dimensions     = getimagesize($outputPath);

            try {
                CompressionReport::create([
                    'action'            => 'url_compress',
                    'referrer'          => Str::limit($url, 500),
                    'original_name'     => basename(parse_url($url, PHP_URL_PATH) ?? 'image'),
                    'original_format'   => self::MIME_TO_EXT[$mime] ?? 'unknown',
                    'output_format'     => $outputExt,
                    'original_size'     => $originalSize,
                    'compressed_size'   => $compressedSize,
                    'reduction_percent' => $reduction,
                    'quality'           => $quality,
                    'width'             => $dimensions[0] ?? null,
                    'height'            => $dimensions[1] ?? null,
                    'ip_address'        => $request->ip(),
                    'user_agent'        => Str::limit($request->userAgent(), 250),
                ]);
            } catch (\Throwable $e) { report($e); }

            return response()->json([
                'success'              => true,
                'filename'             => $outputFilename,
                'download_url'         => route('image.download', ['filename' => $outputFilename]),
                'original_url'         => $url,
                'original_size'        => $originalSize,
                'compressed_size'      => $compressedSize,
                'reduction'            => $reduction,
                'format'               => strtoupper($outputExt),
                'width'                => $dimensions[0] ?? null,
                'height'               => $dimensions[1] ?? null,
                'formatted_original'   => $this->formatBytes($originalSize),
                'formatted_compressed' => $this->formatBytes($compressedSize),
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Failed to process image from URL. Please try again.',
            ], 500);
        }
    }

    // ─────────────────────────────────────────────────────────────────
    // Helpers
    // ─────────────────────────────────────────────────────────────────

    /**
     * SSRF: return true if IP is private/loopback/reserved.
     */
    private function isPrivateIp(string $ip): bool
    {
        return !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)
            && !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE);
    }

    private function getEncoder(string $format, int $quality)
    {
        return match (strtolower($format)) {
            'jpg', 'jpeg' => new JpegEncoder(quality: $quality),
            'png'         => new PngEncoder(),
            'webp'        => new WebpEncoder(quality: $quality),
            'gif'         => new GifEncoder(),
            default       => new JpegEncoder(quality: $quality),
        };
    }

    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $index = 0;
        $size  = (float) $bytes;
        while ($size >= 1024 && $index < count($units) - 1) {
            $size /= 1024;
            $index++;
        }
        return round($size, $precision) . ' ' . $units[$index];
    }

    /**
     * GD-based watermark fallback (no TTF font needed).
     */
    private function applyWatermarkWithGd(
        string $sourcePath,
        string $outputPath,
        string $outputExt,
        string $text,
        string $position,
        int $opacity,
        int $quality
    ): void {
        $src  = imagecreatefromstring((string) file_get_contents($sourcePath));
        if ($src === false) {
            throw new \RuntimeException('GD could not read image.');
        }
        $imgW  = imagesx($src);
        $imgH  = imagesy($src);
        $alpha = (int) ((100 - $opacity) * 1.27);
        $color = imagecolorallocatealpha($src, 255, 255, 255, max(0, min(127, $alpha)));
        $charW = 6;
        $charH = 12;
        $pad   = 10;
        $tw    = $charW * strlen($text);

        [$x, $y] = match ($position) {
            'bottom-right' => [$imgW - $tw - $pad, $imgH - $charH - $pad],
            'bottom-left'  => [$pad, $imgH - $charH - $pad],
            'top-right'    => [$imgW - $tw - $pad, $pad],
            'top-left'     => [$pad, $pad],
            'center'       => [(int) (($imgW - $tw) / 2), (int) (($imgH - $charH) / 2)],
            default        => [$imgW - $tw - $pad, $imgH - $charH - $pad],
        };

        imagestring($src, 3, $x, $y, $text, $color);

        if ($outputExt === 'jpg') {
            imagejpeg($src, $outputPath, $quality);
        } elseif ($outputExt === 'png') {
            imagepng($src, $outputPath, 9);
        } else {
            imagewebp($src, $outputPath, $quality);
        }
        imagedestroy($src);
    }
}
