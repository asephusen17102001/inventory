<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
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

    // Ajax get store by id
    Route::get('stores/ajax_get_store', [StoreController::class, 'ajax_get_store'])->name('stores.ajax_get_store');
    // Store save product by store
    Route::post('stores/save-store-products/{store}', [StoreController::class, 'save_store_product'])->name('stores.save_store_product');
    // Delete store product
    Route::delete('stores/delete-store-product/{storeProduct}', [StoreController::class, 'delete_store_product'])->name('stores.delete_store_product');
    // Store
    Route::resource('stores', StoreController::class)->names('stores');

    // User
    Route::resource('users', UserController::class)->names('users');

    // Transaction : penarikan and pemasangan
    Route::get('transactions/{type}', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('transactions/store/{type}', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('transactions/create/{type}', [TransactionController::class, 'create'])->name('transactions.create');
    Route::get('transactions/show/{type}/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');


    // Report
    Route::get('reports/stock/{type}', [ReportController::class, 'index'])->name('reports.stock');
});
