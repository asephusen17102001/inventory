<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stores = Store::where('branch_id', Auth::user()->branch->id)->orderBy('name')->get();
        return view('branch.stores.index', compact(['stores']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
        $store->load('storeProducts');
        $store->load('Transactions');
        $store->transactions->load('detailProductTransactions.product');
        $store->detailProductTransactions = $store->transactions->flatMap(function ($transaction) {
            return $transaction->detailProductTransactions->load('product');
        })->sortBy('tanggal_transaction')->unique('id');


        // kode di atas error Method Illuminate\Support\Collection::load does not exist.


        //
        $selectedProductIds = StoreProduct::where('store_id', $store->id)->pluck('product_id');


        $products = $selectedProductIds->isEmpty()
            ? Product::all()
            : Product::whereNotIn('id', $selectedProductIds)->get();

        return view('branch.stores.show', compact('store', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
