<?php

namespace App\Http\Controllers;

use App\Models\TransactionHistory;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        $histories = TransactionHistory::with(['user', 'transaction'])
            ->latest()
            ->paginate(10);

        return view('history.index', compact('histories'));
    }
}