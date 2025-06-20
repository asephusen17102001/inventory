<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $data_grafik = [];

        // Loop dari bulan 1 sampai 12 (Januari - Desember)
        for ($i = 1; $i <= 12; $i++) {

            $total_transaksi_penarikan = Transaction::where('type', 'penarikan')
                ->whereMonth('tanggal_transaction', $i)
                ->whereYear('tanggal_transaction', date('Y'))
                ->count();

            $total_transaksi_pemasangan = Transaction::where('type', 'pemasangan')
                ->whereMonth('tanggal_transaction', $i)
                ->whereYear('tanggal_transaction', date('Y'))
                ->count();

            $data_grafik['total_transaksi_penarikan'][] = $total_transaksi_penarikan;
            $data_grafik['total_transaksi_pemasangan'][] = $total_transaksi_pemasangan;
        }

        $total_produk = Product::count();
        $total_branch = Branch::count();
        $total_toko = Store::count();
        $total_user = User::count();

        $total_transaksi['penarikan_per_mont'] = Transaction::where('type', 'penarikan')->whereMonth('tanggal_transaction', date('m'))->count();
        $total_transaksi['pemasangan_per_mont'] = Transaction::where('type', 'pemasangan')->whereMonth('tanggal_transaction', date('m'))->count();

        $stock_tersedia =  Product::where('status', 'active')->sum('stock');

        return view('admin.dashboard', compact(
            'total_produk',
            'total_branch',
            'total_toko',
            'total_user',
            'data_grafik',
            'total_transaksi',
            'stock_tersedia'
        ));
    }
}
