<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTransaksi = Transaction::count();

        // Ambil ID type berdasarkan name
        $pemasukanId   = Type::where('name', 'Pemasukan')->value('id');
        $pengeluaranId = Type::where('name', 'Pengeluaran')->value('id');

        // Hitung total berdasarkan type_id
        $totalPemasukan   = $pemasukanId ? Transaction::where('type_id', $pemasukanId)->sum('amount') : 0;
        $totalPengeluaran = $pengeluaranId ? Transaction::where('type_id', $pengeluaranId)->sum('amount') : 0;

        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        return view('dashboard', compact(
            'totalTransaksi',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoAkhir'
        ));

        
    }
}
