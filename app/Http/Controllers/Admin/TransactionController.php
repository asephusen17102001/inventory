<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\DetailProductTransaction;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $type)
    {
        $f_tanggal = date('Y-m-d');
        if (@$request->input('f_tanggal')) {
            $f_tanggal = $request->input('f_tanggal');
        }
        $transactions = Transaction::where('type', $type)
            ->whereDate('tanggal_transaction', $f_tanggal)
            ->with(['store', 'detailProductTransactions.product'])
            ->orderBy('tanggal_transaction', 'ASC')
            ->get();


        // page penarikan
        if ($type == "penarikan")  return view('admin.transactions.penarikan.index', compact('type', 'transactions', 'f_tanggal'));


        // page pemasangan
        return view('admin.transactions.pemasangan.index', compact('type', 'transactions', 'f_tanggal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type)
    {
        $stores = Store::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        if ($type == "penarikan") {
            return view('admin.transactions.penarikan.create', compact('type', 'stores', 'products'));
        } else {
            return view('admin.transactions.pemasangan.create', compact('type', 'stores', 'products'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $type)
    {
        //
        try {

            $transaction = Transaction::create([
                'nomor_transaction' => $request->input('nomor_transaction'),
                'tanggal_transaction' => $request->input('tanggal_transaction'),
                'store_id' => $request->input('store_id'),
                'type' => $type,
            ]);

            foreach ($request->input('product_id') as $key => $value) {
                $data['product_id'] = $value;
                $data['qty'] = str_replace('.', '', $request->input('qty')[$key]);

                DetailProductTransaction::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $data['product_id'],
                    'qty' => $data['qty'],
                ]);

                // Update product stock
                $product = Product::find($data['product_id']);
                if ($type == 'penarikan') {
                    $product->stock += $data['qty'];
                } else {
                    $product->stock -= $data['qty'];
                }
                $product->save();
            }

            return redirect()->route('admin.transactions.index', ['type' => $type])
                ->with('success', 'Transaction ' . ucwords($type));
        } catch (\Throwable $th) {
            return back()->with('failed', $th->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($type, Transaction $transaction)
    {

        $transaction->load(['detailProductTransactions']);
        // page penarikan
        if ($type == "penarikan") return view('admin.transactions.penarikan.show', compact('type', 'transaction'));

        // page pemasangan
        return view('admin.transactions.pemasangan.show', compact('type', 'transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
