<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $total_produk = Product::count();
        $total_branch = Branch::count();
        $total_toko = Store::count();
        $total_user = User::count();
        return view('admin.dashboard', compact(
            'total_produk',
            'total_branch',
            'total_toko',
            'total_user',
        ));
    }
}
