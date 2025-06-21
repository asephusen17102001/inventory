<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $total_toko = Auth::user()->branch->stores()->count();


        $data_grafik = [];

        // Loop dari bulan 1 sampai 12 (Januari - Desember)
        for ($i = 1; $i <= 12; $i++) {

            $total_transaksi_penarikan = Transaction::whereHas('store', function ($q) {
                $q->where('branch_id', Auth::user()->branch->id);
            })->where('type', 'penarikan')
                ->whereMonth('tanggal_transaction', $i)
                ->whereYear('tanggal_transaction', date('Y'))
                ->count();

            $total_transaksi_pemasangan = Transaction::whereHas('store', function ($q) {
                $q->where('branch_id', Auth::user()->branch->id);
            })->where('type', 'pemasangan')
                ->whereMonth('tanggal_transaction', $i)
                ->whereYear('tanggal_transaction', date('Y'))
                ->count();

            $data_grafik['total_transaksi_penarikan'][] = $total_transaksi_penarikan;
            $data_grafik['total_transaksi_pemasangan'][] = $total_transaksi_pemasangan;
        }


        $total_transaksi['penarikan_per_mont'] = Transaction::whereHas('store', function ($q) {
            $q->where('branch_id', Auth::user()->branch->id);
        })->where('type', 'penarikan')->whereMonth('tanggal_transaction', date('m'))->count();
        $total_transaksi['pemasangan_per_mont'] = Transaction::whereHas('store', function ($q) {
            $q->where('branch_id', Auth::user()->branch->id);
        })->where('type', 'pemasangan')->whereMonth('tanggal_transaction', date('m'))->count();

        return view('branch.dashboard', compact('total_toko', 'total_transaksi', 'data_grafik'));
    }
}
