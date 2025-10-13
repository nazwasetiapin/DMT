<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Exports\GuestsExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/guests/export/excel', function () {
    return Excel::download(new GuestsExport, 'data-tamu.xlsx');
})->name('guests.export.excel');


// Form Buku Tamu
Route::get('/', [GuestController::class, 'create'])->name('guests.create');

// Simpan Buku Tamu
Route::post('/guests', [GuestController::class, 'store'])->name('guests.store');


// Halaman Terima Kasih
Route::get('/thankyou', [GuestController::class, 'thankyou'])->name('guests.thankyou');

// Monitor daftar tamu (misal ditampilkan di layar projector)
Route::get('/monitor', [GuestController::class, 'monitor'])->name('guests.monitor');

// Album data-list tamu 
Route::get('/album', [GuestController::class, 'album'])->name('guests.album');

Route::delete('/guests/{guest}', [App\Http\Controllers\GuestController::class, 'destroy'])->name('guests.destroy');


// halaman data tamu/album
Route::get('/admin', [GuestController::class, 'data'])->name('guests.data');

// export pdf album
Route::get('/guests/export/pdf-album', [GuestController::class, 'exportPdfAlbum'])->name('guests.export.pdf.album');

// export pdf data
Route::get('/guests/export/pdf-data', [GuestController::class, 'exportPdfData'])->name('guests.export.pdf.data');
