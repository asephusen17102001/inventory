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
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        //
        try {

            $transaction = Transaction::create([
                'nomor_transaction' => $request->input('nomor_transaction'),
                'tanggal_transaction' => $request->input('tanggal_transaction'),
                'store_id' => $request->input('store_id'),
                'type' => $type,
            ]);

            foreach ($request->input('product_id') as $index => $value) {

                $qty = str_replace('.', '', $request->input('qty')[$index]);
                $type_product = $request->input('type')[$index];
                $price = $request->input('price')[$index];

                if (empty($qty) || $qty < 1) continue;

                DetailProductTransaction::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $value,
                    'qty' => $qty,
                    'type' => $type_product,
                    'price' => $price,
                ]);


                // Update product stock BK
                $product = Product::find($value);
                $store_product = $product->storeProducts()->where('store_id', $transaction->store_id)->first();
                if ($type == 'penarikan') {
                    // update stock di BK
                    $product->stock_recondition += $qty;

                    // update stock produk di toko
                    $store_product->stock -= $qty;
                    $store_product->stock_product_repair += $qty;
                } else {
                    // update stock di Gudang BK

                    if ($type_product == 'baru') {
                        $product->stock -= $qty;
                    } else {
                        // jika produk bekas, kurangi stock recondition
                        $product->stock_recondition -= $qty;
                    }

                    // update stock produk di toko
                    $store_product->stock += $qty;
                    $store_product->stock_product_repair -= $qty;
                }

                // save produk di BK
                $product->save();

                // save produk di toko
                $store_product->save();

                DB::commit();
            }

            return redirect()->route('admin.transactions.index', ['type' => $type])
                ->with('success', 'Transaction ' . ucwords($type));
        } catch (\Throwable $th) {
            DB::rollBack();
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
