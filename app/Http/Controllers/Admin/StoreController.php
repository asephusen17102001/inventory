<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Branch;
use App\Models\Product;
use App\Models\StoreProduct;
use Illuminate\Http\Request;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $branches = Branch::orderBy('name')->get();
        $stores = Store::orderBy('name')->get();
        return view('admin.stores.index', compact(['branches', 'stores']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $branches = Branch::orderBy('name')->get();
        return view('admin.stores.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        //
        $validated = $request->validated();
        //
        try {
            //code...
            Store::create($validated);

            return redirect(route('admin.stores.index'))->with('success', 'Tambah Toko');
        } catch (\Throwable $th) {
            //throw $th;

            return back()->with('failed', $th->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        $store->load('storeProducts');
        //
        $selectedProductIds = StoreProduct::where('store_id', $store->id)->pluck('product_id');


        $products = $selectedProductIds->isEmpty()
            ? Product::all()
            : Product::whereNotIn('id', $selectedProductIds)->get();

        return view('admin.stores.show', compact('store', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
        $branches = Branch::orderBy('name')->get();
        return view('admin.stores.edit', compact(['branches', 'store']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        //
        // Validate request data

        $validated = $request->validated();

        try {
            // Update product with validated data
            $store->update($validated);

            return redirect()
                ->route('admin.stores.index')
                ->with('success', 'Edit Toko');
        } catch (\Throwable $th) {
            return back()
                ->with('failed', 'Hapus Toko : ' . $th->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
        $store->delete();
        return response()->json(['message' => 'Hapus Toko']);
    }



    /**
     * Get store by id for ajax request.
     */
    public function ajax_get_store(Request $request)
    {
        if (!$request->id) {
            return response()->json(['error' => 'ID tidak diberikan'], 400);
        }

        $store = Store::with(['storeProducts.product'])
            ->where('id', $request->id)
            ->first();

        if (!$store) {
            return response()->json(['error' => 'Store tidak ditemukan'], 404);
        }

        return response()->json($store);
    }


    /**
     * Store products for a specific store.
     */
    public function save_store_product(Request $request, Store $store)
    {

        $validated = $request->validate([
            'product_id' => 'required',
            'stock' => 'required',
            'stock_product_repair' => 'required'
        ]);

        try {
            $validated['store_id'] = $store->id;

            StoreProduct::create($validated);

            // Redirect back to the store's page with success message
            return redirect()
                ->route('admin.stores.show', ['store' => $store])
                ->with('success', 'Produk berhasil disimpan untuk toko');
        } catch (\Throwable $th) {
            return back()
                ->with('failed', 'Gagal menyimpan produk: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function delete_store_product(StoreProduct $storeProduct)
    {
        try {
            $storeProduct->delete();
            return response()->json(['message' => 'Produk berhasil dihapus dari toko']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Gagal menghapus produk: ' . $th->getMessage()], 500);
        }
    }
}
