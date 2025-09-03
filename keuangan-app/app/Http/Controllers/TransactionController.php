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
        $transactions = Transaction::with(['type', 'category', 'subCategory'])->get();
        return view('transactions.index', compact('transactions'));
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
