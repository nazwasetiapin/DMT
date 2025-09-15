<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TransactionController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

///Admin + CEO bisa lihat dashboard
Route::middleware(['auth', 'role:admin|ceo'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Hanya Admin yang bisa input/edit transaksi
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('transactions', TransactionController::class);
});

// Transactions - Pemasukan
Route::prefix('transactions/pemasukan')->middleware('auth')->group(function () {
    Route::get('/', [TransactionController::class, 'pemasukan'])->name('pemasukan.index');
    Route::get('/create', [TransactionController::class, 'createPemasukan'])->name('pemasukan.create');
    Route::get('/{id}/edit', [TransactionController::class, 'editPemasukan'])->name('pemasukan.edit');
});

// Transactions - Pengeluaran
Route::prefix('transactions/pengeluaran')->middleware('auth')->group(function () {
    Route::get('/', [TransactionController::class, 'pengeluaran'])->name('pengeluaran.index');
    Route::get('/create', [TransactionController::class, 'createPengeluaran'])->name('pengeluaran.create');
    Route::get('/{id}/edit', [TransactionController::class, 'editPengeluaran'])->name('pengeluaran.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource utama
Route::middleware(['auth'])->group(function () {
    Route::resource('types', TypeController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('transactions', TransactionController::class);
});

Route::get('/get-subcategories/{category_id}', [SubCategoryController::class, 'getByCategory'])
    ->middleware('auth')
    ->name('subcategories.byCategory');

require __DIR__.'/auth.php';
