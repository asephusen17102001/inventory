<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::orderBy(column: 'name')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        //
        try {
            //code...
            User::create($validated);
            return redirect()->route('admin.users.index')->with('success', 'Tambah User');
        } catch (\Throwable $th) {
            //throw $th;

            return back()->with('failed', $th->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
        // Validate request data
        $validated = $request->validated();

        try {
            // Update product with validated data
            $user->update($validated);

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Edit User');
        } catch (\Throwable $th) {
            return back()
                ->with('failed', 'Hapus User : ' . $th->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return response()->json(['message' => 'Hapus User']);
    }
}
