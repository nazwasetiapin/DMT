<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Pilihan tahun (bisa dikirim via query ?year=2025). Default = tahun sekarang
        $year = $request->get('year', date('Y'));

        // Ambil id type Pemasukan / Pengeluaran (sesuaikan nama di tabel types)
        $pemasukanId   = Type::where('name', 'Pemasukan')->value('id');
        $pengeluaranId = Type::where('name', 'Pengeluaran')->value('id');

        // Hitung total
        $totalPemasukan   = $pemasukanId ? (float) Transaction::where('type_id', $pemasukanId)->sum('amount') : 0;
        $totalPengeluaran = $pengeluaranId ? (float) Transaction::where('type_id', $pengeluaranId)->sum('amount') : 0;
        $totalTransaksi   = Transaction::count();
        $saldoAkhir       = $totalPemasukan - $totalPengeluaran;

        // Labels bulan
        $labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

        // Data per bulan
        $dataPemasukan = [];
        $dataPengeluaran = [];
        for ($m = 1; $m <= 12; $m++) {
            $dataPemasukan[] = $pemasukanId
                ? (float) Transaction::where('type_id', $pemasukanId)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $m)
                    ->sum('amount')
                : 0;

            $dataPengeluaran[] = $pengeluaranId
                ? (float) Transaction::where('type_id', $pengeluaranId)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $m)
                    ->sum('amount')
                : 0;
        }

        // Transaksi terbaru
        $latestTransactions = Transaction::with(['type','category','subCategory'])
            ->orderBy('created_at','desc')
            ->limit(8)
            ->get();

        // Kirim ke view
        return view('dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'totalTransaksi',
            'saldoAkhir',
            'labels',
            'dataPemasukan',
            'dataPengeluaran',
            'latestTransactions',
            'year'
        ));
    }
}
