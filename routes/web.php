<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Image Compressor (Home)
Route::get('/', [ImageController::class, 'index'])->name('home');

Route::post('/compress', [ImageController::class, 'compress'])
    ->name('image.compress')
    ->middleware('throttle:30,1');

Route::get('/download/{filename}', [ImageController::class, 'download'])
    ->name('image.download');

// Image Converter
Route::get('/image-converter', [PdfController::class, 'imageConverter'])->name('image.converter');

// Image to PDF
Route::get('/image-to-pdf', [PdfController::class, 'imageToPdf'])->name('image.to.pdf');
Route::post('/image-to-pdf/convert', [PdfController::class, 'convertImagesToPdf'])
    ->name('image.to.pdf.convert')
    ->middleware('throttle:20,1');

// PDF Compressor
Route::get('/pdf-compressor', [PdfController::class, 'pdfCompressor'])->name('pdf.compressor');
Route::post('/pdf-compressor/compress', [PdfController::class, 'compressPdf'])
    ->name('pdf.compress')
    ->middleware('throttle:20,1');

// Admin authentication routes (using /authorize instead of /login)
Route::get('/authorize', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/authorize', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin protected routes
Route::middleware('admin.auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/admin/api/reports', [ReportController::class, 'data'])->name('reports.data');
});
