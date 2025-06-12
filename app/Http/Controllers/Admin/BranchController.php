<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $branches = Branch::orderBy(column: 'name')->get();
        return view('admin.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {
        $validated = $request->validated();
        //
        try {
            //code...
            Branch::create($validated);
            return redirect()->route('admin.branches.index')->with('success', 'Tambah Branch');
        } catch (\Throwable $th) {
            //throw $th;

            return back()->with('failed', $th->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
        return view('admin.branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        //
        // Validate request data
        $validated = $request->validated();

        try {
            // Update product with validated data
            $branch->update($validated);

            return redirect()
                ->route('admin.branches.index')
                ->with('success', 'Edit Branch');
        } catch (\Throwable $th) {
            return back()
                ->with('failed', 'Hapus Branch : ' . $th->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
        $branch->delete();
        return response()->json(['message' => 'Hapus Branch']);
    }
}
