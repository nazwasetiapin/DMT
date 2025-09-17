<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Type;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
 public function index()
{
    $query = Transaction::with(['type', 'category', 'subCategory'])->latest();

    // Tambahkan filter jika ada input bulan & tahun
    if (request()->filled('month')) {
        $query->whereMonth('tanggal', request('month'));
    }

    if (request()->filled('year')) {
        $query->whereYear('tanggal', request('year'));
    }

    $transactions = $query->get();

    // Hitung total pemasukan & pengeluaran (berdasarkan filter juga)
    $pemasukanId   = Type::where('name', 'Pemasukan')->value('id');
    $pengeluaranId = Type::where('name', 'Pengeluaran')->value('id');

    $totalPemasukan   = $pemasukanId ? $query->clone()->where('type_id', $pemasukanId)->sum('amount') : 0;
    $totalPengeluaran = $pengeluaranId ? $query->clone()->where('type_id', $pengeluaranId)->sum('amount') : 0;

    // Ambil daftar tahun untuk dropdown filter
    $years = Transaction::selectRaw('YEAR(tanggal) as year')
        ->groupBy('year')
        ->orderBy('year', 'desc')
        ->pluck('year');

    // Ringkasan per bulan & tahun (tidak dipengaruhi filter)
    $monthlySums = Transaction::selectRaw('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(amount) as total')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

    $role = auth()->user()->role; 
    
    return view('transactions.index', compact(
        'transactions',
        'totalPemasukan',
        'totalPengeluaran',
        'role',
        'monthlySums',
        'years'
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

        Transaction::create($request->all());
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
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
