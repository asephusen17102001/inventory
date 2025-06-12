<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;





Route::prefix('admin')->as('admin.')->group(function () {

    // Dashboard 
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Product
    Route::resource('products', ProductController::class)->names('products');

    // Branch
    Route::resource('branches', BranchController::class)->names('branches');

    // Store
    Route::resource('stores', StoreController::class)->names('stores');

    // User
    Route::resource('users', UserController::class)->names('users');

    // transaction IN
    Route::get('/transactions/{type}', [TransactionController::class, 'index'])->name('admin.transactions.index');
});
