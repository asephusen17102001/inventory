<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Branch;

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
        //
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
}
