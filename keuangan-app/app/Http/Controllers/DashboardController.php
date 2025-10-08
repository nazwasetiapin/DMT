<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Type;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Filter Tahun & Bulan
        $year = $request->get('year', date('Y'));
        $month = $request->get('month'); // Bisa null (seluruh bulan)

        // Ambil ID tipe Pemasukan & Pengeluaran
        $pemasukanId = Type::where('name', 'Pemasukan')->value('id');
        $pengeluaranId = Type::where('name', 'Pengeluaran')->value('id');

        // =========================
        // 🔹 Summary Cards
        // =========================
        $totalPemasukanQuery = Transaction::where('type_id', $pemasukanId)
            ->whereYear('tanggal', $year);
        $totalPengeluaranQuery = Transaction::where('type_id', $pengeluaranId)
            ->whereYear('tanggal', $year);

        if ($month) {
            $totalPemasukanQuery->whereMonth('tanggal', $month);
            $totalPengeluaranQuery->whereMonth('tanggal', $month);
        }

        $totalPemasukan = (float) $totalPemasukanQuery->sum('amount');
        $totalPengeluaran = (float) $totalPengeluaranQuery->sum('amount');
        $totalTransaksi = Transaction::whereYear('tanggal', $year)
            ->when($month, fn($q) => $q->whereMonth('tanggal', $month))
            ->count();
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // =========================
        // 🔹 Grafik Perbandingan Bulanan
        // =========================
        $labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $dataPemasukan = [];
        $dataPengeluaran = [];

        for ($m = 1; $m <= 12; $m++) {
            $dataPemasukan[] = $pemasukanId
                ? (float) Transaction::where('type_id', $pemasukanId)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $m)
                    ->sum('amount')
                : 0;

            $dataPengeluaran[] = $pengeluaranId
                ? (float) Transaction::where('type_id', $pengeluaranId)
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $m)
                    ->sum('amount')
                : 0;
        }

        // =========================
        // 🔹 Detail Persentase per Bulan (hanya bulan terpilih jika ada)
        // =========================
$detailPersentase = [];

for ($m = 1; $m <= 12; $m++) {
    // jika month dipilih dan bukan bulan ini, lewati
    if ($month && $m != $month) continue;

    $bulanNama = $labels[$m - 1];

    $income = $pemasukanId
        ? (float) Transaction::where('type_id', $pemasukanId)
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $m)
            ->sum('amount')
        : 0;

    $expense = $pengeluaranId
        ? (float) Transaction::where('type_id', $pengeluaranId)
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $m)
            ->sum('amount')
        : 0;

    $total = $income + $expense;
    $incomePercent = $total > 0 ? round(($income / $total) * 100, 1) : 0;
    $expensePercent = $total > 0 ? round(($expense / $total) * 100, 1) : 0;

    // logika status
    if ($income > $expense) {
        $status = 'Naik';
    } elseif ($income < $expense) {
        $status = 'Turun';
    } else {
        $status = 'Stabil';
    }

    $detailPersentase[] = [
        'bulan' => $bulanNama,
        'pemasukan' => $income,
        'pengeluaran' => $expense,
        'pemasukan_persen' => $incomePercent,
        'pengeluaran_persen' => $expensePercent,
        'status' => $status,
    ];
}


        return view('dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'totalTransaksi',
            'saldoAkhir',
            'labels',
            'dataPemasukan',
            'dataPengeluaran',
            'detailPersentase',
            'year',
            'month'
        ));
    }
}
