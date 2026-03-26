<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\T2Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [ImageController::class, 'index'])->name('home');

// Legacy auth URLs redirected to current admin auth entry.
Route::redirect('/login', '/authorize', 301);
Route::redirect('/admin/login', '/authorize', 301);

Route::get('/privacy-policy', fn () => view('legal.privacy'))->name('privacy');
Route::get('/terms', fn () => view('legal.terms'))->name('terms');

// Content pages (AdSense compliance — unique, high-quality content)
Route::get('/about', fn () => view('pages.about'))->name('about');
Route::get('/contact', fn () => view('pages.contact'))->name('contact');

// Individual tool landing pages (SEO — crawlable dedicated pages)
Route::get('/tools/compress', fn () => view('tools.compress'))->name('tool.compress');
Route::get('/tools/convert', fn () => view('tools.convert'))->name('tool.convert');
Route::get('/tools/resize', fn () => view('tools.resize'))->name('tool.resize');
Route::get('/tools/batch-compress', fn () => view('tools.batch-compress'))->name('tool.batch');
Route::get('/tools/watermark', fn () => view('tools.watermark'))->name('tool.watermark');
Route::get('/tools/image-to-pdf', fn () => view('tools.image-to-pdf'))->name('tool.img2pdf');
Route::get('/tools/pdf-to-image', fn () => view('tools.pdf-to-image'))->name('tool.pdf2img');

// Blog
 $blogSlugs = [
    'how-to-compress-images-for-web',
    'webp-vs-jpg-vs-png',
    'image-seo-best-practices',
    'reduce-image-size-for-email',
    'core-web-vitals-image-optimization',
    'batch-image-compression-workflow',
    'best-image-formats-for-social-media',
    'how-to-add-watermark-to-photos',
    'optimize-images-for-wordpress',
    'convert-images-to-pdf-guide',
];

Route::get('/blog', fn () => view('blog.index'))->name('blog');
Route::get('/sitemap', fn () => view('pages.sitemap', ['blogSlugs' => $blogSlugs]))->name('sitemap.html');

Route::get('/blog/{slug}', function (string $slug) use ($blogSlugs) {
    if (! in_array($slug, $blogSlugs, true)) {
        abort(404);
    }
    return view('blog.' . $slug);
})->name('blog.show')->where('slug', '[a-z0-9\-]+');

// ── All image-processing routes get the MemoryGuard middleware ──────────────
Route::middleware('memory.guard')->group(function () {

    Route::post('/api/' . config('api_routes.compress'), [ImageController::class, 'compress'])
        ->name('image.compress')
        ->middleware('throttle:30,1');

    Route::post('/api/' . config('api_routes.convert'), [ImageController::class, 'convert'])
        ->name('image.convert')
        ->middleware('throttle:30,1');

    Route::post('/api/' . config('api_routes.chunk'), [ImageController::class, 'uploadChunk'])
        ->name('upload.chunk')
        ->middleware('throttle:300,1');

    Route::post('/api/' . config('api_routes.finalize'), [ImageController::class, 'finalizeUpload'])
        ->name('upload.finalize')
        ->middleware('throttle:60,1');

    // T2 Routes
    Route::post('/api/' . config('api_routes.batch'), [T2Controller::class, 'compressBatch'])
        ->name('batch.compress')
        ->middleware('throttle:30,1');

    Route::post('/api/' . config('api_routes.batch_zip'), [T2Controller::class, 'downloadBatchZip'])
        ->name('batch.zip')
        ->middleware('throttle:30,1');

    Route::post('/api/' . config('api_routes.resize'), [T2Controller::class, 'resize'])
        ->name('image.resize')
        ->middleware('throttle:30,1');

    Route::post('/api/' . config('api_routes.img_to_pdf'), [T2Controller::class, 'imageToPdf'])
        ->name('image.to.pdf')
        ->middleware('throttle:30,1');

    Route::post('/api/' . config('api_routes.pdf_to_img'), [T2Controller::class, 'pdfToImage'])
        ->name('pdf.to.image')
        ->middleware('throttle:30,1');

    Route::post('/api/' . config('api_routes.watermark'), [T2Controller::class, 'watermark'])
        ->name('image.watermark')
        ->middleware('throttle:30,1');

    Route::post('/api/' . config('api_routes.url_press'), [T2Controller::class, 'compressFromUrl'])
        ->name('url.compress')
        ->middleware('throttle:30,1');

    // T2 Chunked upload routes
    Route::post('/api/' . config('api_routes.t2_chunk'), [T2Controller::class, 'uploadChunk'])
        ->name('t2.chunk')
        ->middleware('throttle:300,1');

    Route::post('/api/' . config('api_routes.t2_finalize'), [T2Controller::class, 'finalizeChunked'])
        ->name('t2.finalize')
        ->middleware('throttle:60,1');

    Route::post('/api/' . config('api_routes.batch_finalize'), [T2Controller::class, 'finalizeBatch'])
        ->name('batch.finalize')
        ->middleware('throttle:60,1');
});

// Download routes
Route::get('/dl/{filename}', [ImageController::class, 'download'])
    ->name('image.download');

Route::get('/pdf/{filename}', [T2Controller::class, 'downloadPdf'])
    ->name('pdf.download');

// Graceful GET fallback for POST-only API routes (prevents MethodNotAllowedHttpException)
Route::get('/api/' . config('api_routes.batch_zip'), fn () => response()->json([
    'success' => false,
    'message' => 'This endpoint only accepts POST requests.',
], 405))->name('batch.zip.get');

Route::get('/api/{any}', fn () => response()->json([
    'success' => false,
    'message' => 'API endpoints only accept POST requests.',
], 405, ['X-Robots-Tag' => 'noindex, nofollow, noarchive']))
    ->where('any', '.*')
    ->name('api.get.fallback');

// Admin authentication routes (using /authorize instead of /login)
Route::get('/authorize', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/authorize', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin protected routes
Route::middleware('admin.auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/admin/api/reports', [ReportController::class, 'data'])->name('reports.data');
    Route::get('/admin/export', [ReportController::class, 'export'])->name('reports.export');
});

Route::fallback(fn () => response('Not Found', 404, [
    'X-Robots-Tag' => 'noindex, nofollow, noarchive',
]));
