<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function stock(Request $request, $type)
    {
        $branches = Branch::orderBy('name')->get();
        $stores = [];

        $page = '';

        if ($type == "terpasang") {
            $page = 'admin.reports.stock_terpasang';
        }

        if ($type == "repair") {
            $page = 'admin.reports.stock_repair';
        }

        if ($type == "bk") {
            $page = 'admin.reports.stock_bk';
        }

        $products = Product::where('status', 'active')->orderBy('name')->get();

        if ($request->input('branch_id')) {
            $stores = Store::where('branch_id', $request->input('branch_id'))->get();
        }

        return view($page, compact('branches', 'products', 'stores'));
    }


    public function transaction(Request $request, $type)
    {
        $transactions = [];
        $page = '';

        if ($type == "penarikan") {
            $page = 'admin.reports.transaction_penarikan';
        }

        if ($type == "pemasangan") {
            $page = 'admin.reports.transaction_pemasangan';
        }

        if ($request->input('f_tanggal_start') && $request->input('f_tanggal_end')) {
            $transactions = Transaction::where('type', $type)
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
