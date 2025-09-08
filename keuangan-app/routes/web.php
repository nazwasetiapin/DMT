<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TransactionController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Semua Data Transaksi
Route::get('/transactions', function () {
    return view('transactions.index'); // ini file index.blade.php utama
})->name('transactions.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Transactions - Pemasukan
Route::prefix('transactions/pemasukan')->group(function () {
    Route::get('/', function () {
        return view('transactions.pemasukan.index');
    })->name('pemasukan.index');

    Route::get('/create', function () {
        return view('transactions.pemasukan.create');
    })->name('pemasukan.create');

    Route::get('/{id}/edit', function ($id) {
        return view('transactions.pemasukan.edit', compact('id'));
    })->name('pemasukan.edit');
    
});

// Transactions - Pengeluaran
Route::prefix('transactions/pengeluaran')->group(function () {
    Route::get('/', function () {
        return view('transactions.pengeluaran.index');
    })->name('pengeluaran.index');

    Route::get('/create', function () {
        return view('transactions.pengeluaran.create');
    })->name('pengeluaran.create');

    Route::get('/{id}/edit', function ($id) {
        return view('transactions.pengeluaran.edit', compact('id'));
    })->name('pengeluaran.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('types', TypeController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('transactions', TransactionController::class);
    
});

require __DIR__.'/auth.php';
