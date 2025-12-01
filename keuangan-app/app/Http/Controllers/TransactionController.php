<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Type;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use App\Notifications\TransactionNotification;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
   public function index()
{
    $query = Transaction::with(['type', 'category', 'subCategory'])->latest();

    // 🔹 Filter berdasarkan bulan
    if (request()->filled('month')) {
        $query->whereMonth('tanggal', request('month'));
    }

    // 🔹 Filter berdasarkan tahun
    if (request()->filled('year')) {
        $query->whereYear('tanggal', request('year'));
    }

    // 🔹 Filter berdasarkan tipe (Pemasukan / Pengeluaran)
    if (request()->filled('type_id')) {
        $query->where('type_id', request('type_id'));
    }

    // Ambil hasil filter (untuk perhitungan)
    $filteredQuery = clone $query;

    /**
     * =============================
     * Perhitungan Total
     * =============================
     */
    // Cari data di tabel types (melalui model Type) yang kolom name-nya bernilai 'Pemasukan', lalu ambil nilai dari kolom id
    $pemasukanId = Type::where('name', 'Pemasukan')->value('id');
    $pengeluaranId = Type::where('name', 'Pengeluaran')->value('id');

    $totalPemasukan = $pemasukanId
        ? (clone $filteredQuery)->where('type_id', $pemasukanId)->sum('amount')
        : 0;

    $totalPengeluaran = $pengeluaranId
        ? (clone $filteredQuery)->where('type_id', $pengeluaranId)->sum('amount')
        : 0;

    // Hitung saldo akhir
    $saldo = $totalPemasukan - $totalPengeluaran;

    /**
     * =============================
     * Untuk tampilan
     * =============================
     */
    $years = Transaction::selectRaw('YEAR(tanggal) as year')
        ->groupBy('year')
        ->orderBy('year', 'desc')
        ->pluck('year');

    $monthlySums = Transaction::selectRaw('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(amount) as total')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

    $role = auth()->user()->role;

    // 🔹 Tambahkan ini — ambil data untuk dropdown filter
    $types = Type::all();
    $categories = Category::all();

     // ✅ Pagination + simpan query filter
    $transactions = $query->paginate(8)->appends(request()->all());

    // 🔹 Kirim semua data ke view
    return view('transactions.index', compact(
        'transactions',
        'totalPemasukan',
        'totalPengeluaran',
        'saldo',
        'role',
        'monthlySums',
        'years',
        'types',
        'categories'
    ));
}


    public function create()
    {
        $types = Type::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('transactions.create', compact('types', 'categories', 'subCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required|exists:types,id',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'amount' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan transaksi baru
        $transaction = Transaction::create($request->all());

        // 🔔 Kirim notifikasi ke CEO & Admin
        $users = User::whereIn('role', ['CEO', 'Admin'])->get();
        foreach ($users as $user) {
            $user->notify(new TransactionNotification($transaction));
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        // Tandai notifikasi sebagai sudah dibaca kalau ada notif_id
        if ($notifId = request()->query('notif_id')) {
            auth()->user()->notifications()
                ->where('id', $notifId)
                ->first()?->markAsRead();
        }

        return view('transactions.show', compact('transaction'));
    }
    public function edit(Transaction $transaction)
    {
        $types = Type::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('transactions.edit', compact('transaction', 'types', 'categories', 'subCategories'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'type_id' => 'required|exists:types,id',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'amount' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        $transaction->update($request->all());
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }

}
