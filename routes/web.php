<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [ImageController::class, 'index'])->name('home');

Route::post('/api/' . config('api_routes.compress'), [ImageController::class, 'compress'])
    ->name('image.compress')
    ->middleware('throttle:30,1');

Route::post('/api/' . config('api_routes.convert'), [ImageController::class, 'convert'])
    ->name('image.convert')
    ->middleware('throttle:30,1');

Route::post('/api/' . config('api_routes.chunk'), [ImageController::class, 'uploadChunk'])
    ->name('upload.chunk')
    ->middleware('throttle:120,1');

Route::post('/api/' . config('api_routes.finalize'), [ImageController::class, 'finalizeUpload'])
    ->name('upload.finalize')
    ->middleware('throttle:30,1');

Route::get('/dl/{filename}', [ImageController::class, 'download'])
    ->name('image.download');

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
