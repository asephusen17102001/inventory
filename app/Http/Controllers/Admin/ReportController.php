<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index(Request $request, $type)
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

        $products = Product::where('status', 'active')->orderBy('name')->get();

        if ($request->input('branch_id')) {
            $stores = Store::where('branch_id', $request->input('branch_id'))->get();
        }

        return view($page, compact('branches', 'products', 'stores'));
    }
}
