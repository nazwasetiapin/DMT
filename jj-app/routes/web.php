<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AdminUploadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JJController;
use App\Http\Controllers\AuthController;

// Home
Route::get('/', function () {
    return view('pages.home');
});

// Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Upload logic
Route::post('/upload', [UploadController::class, 'store'])->name('upload.store')->middleware('auth');

// Upload selector
Route::get('/jj/pilih', function () {
    return view('jj.select');
})->name('jj.select');

// Upload form
Route::get('/jj/create', [JJController::class, 'create'])->name('jj.create');
Route::post('/upload-jj', [JJController::class, 'store'])->name('jj.store');

// Terpisah: Upload foto & video
Route::middleware(['auth'])->group(function () {
    Route::get('/jj/create-foto', [JJController::class, 'createFoto'])->name('jj.create.foto');
    Route::get('/jj/create-video', [JJController::class, 'createVideo'])->name('jj.create.video');
    Route::get('/jj/create-video-gratis', [JJController::class, 'createVideoGratis'])->name('jj.create.video.gratis');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile update
Route::post('/update-akun', [ProfileController::class, 'update'])->name('akun.update');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/uploads', [AdminUploadController::class, 'index'])->name('admin.uploads.index');
    Route::get('/uploads/{id}/edit', [AdminUploadController::class, 'edit'])->name('admin.uploads.edit');
    Route::put('/uploads/{id}', [AdminUploadController::class, 'update'])->name('admin.uploads.update');
});

require __DIR__.'/auth.php';
