<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // =========================
        // 🔹 Filter Tahun & Bulan
        // =========================
        $year = $request->get('year', date('Y'));
        $month = $request->get('month'); // bisa null

        // =========================
        // 🔹 Label Bulan (WAJIB ADA)
        // =========================
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        // =========================
        // 🔹 Ambil ID Type
        // =========================
        $pemasukanId   = Type::where('name', 'Pemasukan')->value('id');
        $pengeluaranId = Type::where('name', 'Pengeluaran')->value('id');

        // =========================
        // 🔹 DEFAULT VALUE (ANTI ERROR)
        // =========================
        $totalPemasukan   = 0;
        $totalPengeluaran = 0;
        $totalTransaksi   = 0;
        $saldoAkhir       = 0;
        $dataPemasukan    = array_fill(0, 12, 0);
        $dataPengeluaran  = array_fill(0, 12, 0);
        $detailPersentase = [];

        // =========================
        // 🔹 PROSES DATA JIKA TYPE ADA
        // =========================
        if ($pemasukanId && $pengeluaranId) {

            // =========================
            // 🔹 Data Bulanan (Optimasi)
            // =========================
            $monthlyIncome = Transaction::where('type_id', $pemasukanId)
                ->whereYear('tanggal', $year)
                ->selectRaw('MONTH(tanggal) as bulan, SUM(amount) as total')
                ->groupBy('bulan')
                ->pluck('total', 'bulan')
                ->toArray();

            $monthlyExpense = Transaction::where('type_id', $pengeluaranId)
                ->whereYear('tanggal', $year)
                ->selectRaw('MONTH(tanggal) as bulan, SUM(amount) as total')
                ->groupBy('bulan')
                ->pluck('total', 'bulan')
                ->toArray();

            for ($m = 1; $m <= 12; $m++) {
                $dataPemasukan[]   = (float) ($monthlyIncome[$m] ?? 0);
                $dataPengeluaran[] = (float) ($monthlyExpense[$m] ?? 0);
            }

            // =========================
            // 🔹 Summary Cards
            // =========================
            $pemasukanQuery = Transaction::where('type_id', $pemasukanId)
                ->whereYear('tanggal', $year);

            $pengeluaranQuery = Transaction::where('type_id', $pengeluaranId)
                ->whereYear('tanggal', $year);

            if ($month) {
                $pemasukanQuery->whereMonth('tanggal', $month);
                $pengeluaranQuery->whereMonth('tanggal', $month);
            }

            $totalPemasukan   = (float) $pemasukanQuery->sum('amount');
            $totalPengeluaran = (float) $pengeluaranQuery->sum('amount');

            $totalTransaksi = Transaction::whereYear('tanggal', $year)
                ->when($month, fn ($q) => $q->whereMonth('tanggal', $month))
                ->count();

            $saldoAkhir = $totalPemasukan - $totalPengeluaran;

            // =========================
            // 🔹 Detail Persentase
            // =========================
            $prevLaba   = 0;
            $startMonth = $month ?: 1;
            $endMonth   = $month ?: 12;

            for ($m = $startMonth; $m <= $endMonth; $m++) {

                $income  = (float) ($monthlyIncome[$m] ?? 0);
                $expense = (float) ($monthlyExpense[$m] ?? 0);
                $laba    = $income - $expense;
                $total   = $income + $expense;

                $detailPersentase[] = [
                    'bulan'              => $labels[$m - 1],
                    'pemasukan'          => $income,
                    'pengeluaran'        => $expense,
                    'laba'               => $laba,
                    'pemasukan_persen'   => $total > 0 ? round(($income / $total) * 100, 1) : 0,
                    'pengeluaran_persen' => $total > 0 ? round(($expense / $total) * 100, 1) : 0,
                    'laba_persen'        => $total > 0 ? round(($laba / $total) * 100, 1) : 0,
                    'status'             => $laba > $prevLaba ? 'Naik' : ($laba < $prevLaba ? 'Turun' : 'Stabil'),
                ];

                $prevLaba = $laba;
            }
        }

        // =========================
        // 🔹 RETURN VIEW
        // =========================
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