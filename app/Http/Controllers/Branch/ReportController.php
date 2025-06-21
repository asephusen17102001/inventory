<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //
    public function transaction(Request $request, $type)
    {
        $transactions = [];
        $page = '';

        if ($type == "penarikan") {
            $page = 'branch.reports.transaction_penarikan';
        }

        if ($type == "pemasangan") {
            $page = 'branch.reports.transaction_pemasangan';
        }

        if ($request->input('f_tanggal_start') && $request->input('f_tanggal_end')) {
            $transactions = Transaction::whereHas('store', function ($store) {
                $store->where('branch_id', Auth::user()->branch->id);
            })->where('type', $type)
                ->whereDate(
                    'tanggal_transaction',
                    '>=',
                    $request->input('f_tanggal_start')
                )
                ->whereDate(
                    'tanggal_transaction',
                    '<=',
                    $request->input('f_tanggal_end')
                )->get();
        }

        return view($page, compact('transactions'));
    }
}
