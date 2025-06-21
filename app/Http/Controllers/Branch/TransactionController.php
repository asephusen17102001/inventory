<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //
    public function show($type, Transaction $transaction)
    {

        $transaction->load(['detailProductTransactions']);
        // page penarikan
        if ($type == "penarikan") return view('branch.transactions.penarikan.show', compact('type', 'transaction'));

        // page pemasangan
        return view('branch.transactions.pemasangan.show', compact('type', 'transaction'));
    }
}
