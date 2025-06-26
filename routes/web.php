<?php


// Controller Akses Admin
use App\Http\Controllers\Admin\BranchController as Admin_BranchController;
use App\Http\Controllers\Admin\DashboardController as Admin_DashboardController;
use App\Http\Controllers\Admin\ProductController as Admin_ProductController;
use App\Http\Controllers\Admin\ReportController as Admin_ReportController;
use App\Http\Controllers\Admin\StoreController as Admin_StoreController;
use App\Http\Controllers\Admin\TransactionController as Admin_TransactionController;
use App\Http\Controllers\Admin\UserController as Admin_UserController;


// Controller Akses Branch
use App\Http\Controllers\Branch\DashboardController as Branch_DashboardController;
use App\Http\Controllers\Branch\ReportController as Branch_ReportController;
use App\Http\Controllers\Branch\TransactionController as Branch_TransactionController;
use App\Http\Controllers\Branch\StoreController as Branch_StoreController;


use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


// default 
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Akse ROle Admin
Route::prefix('admin')->as('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard 
    Route::get('dashboard', [Admin_DashboardController::class, 'index'])->name('dashboard');

    // Product
    Route::resource('products', Admin_ProductController::class)->names('products');

    // Branch
    Route::resource('branches', Admin_BranchController::class)->names('branches');

    // Ajax get store by id
    Route::get('stores/ajax_get_store', [Admin_StoreController::class, 'ajax_get_store'])->name('stores.ajax_get_store');
    // Store save product by store
    Route::post('stores/save-store-products/{store}', [Admin_StoreController::class, 'save_store_product'])->name('stores.save_store_product');
    // Delete store product
    Route::delete('stores/delete-store-product/{storeProduct}', [Admin_StoreController::class, 'delete_store_product'])->name('stores.delete_store_product');
    // Store
    Route::resource('stores', Admin_StoreController::class)->names('stores');

    // User
    Route::resource('users', Admin_UserController::class)->names('users');

    // Transaction : penarikan and pemasangan
    Route::get('transactions/{type}', [Admin_TransactionController::class, 'index'])->name('transactions.index');
    Route::post('transactions/store/{type}', [Admin_TransactionController::class, 'store'])->name('transactions.store');
    Route::get('transactions/create/{type}', [Admin_TransactionController::class, 'create'])->name('transactions.create');
    Route::get('transactions/show/{type}/{transaction}', [Admin_TransactionController::class, 'show'])->name('transactions.show');


    // Report
    // Stock Terpasang, Stock Repair, Stock BK
    Route::get('reports/stocks/{type}', [Admin_ReportController::class, 'stock'])->name('reports.stock');
    // Transaksi Penarikan, Pemasangan
    Route::get('reports/transactions/{type}', [Admin_ReportController::class, 'transaction'])->name('reports.transaction');
});




Route::prefix('branch')->as('branch.')->middleware(['auth', 'role:branch'])->group(function () {

    // Dashboard 
    Route::get('dashboard', [Branch_DashboardController::class, 'index'])->name('dashboard');

    // Store
    Route::resource('stores', Branch_StoreController::class)->names('stores');

    // Transaction : penarikan and pemasangan
    Route::get('transactions/show/{type}/{transaction}', [Branch_TransactionController::class, 'show'])->name('transactions.show');

    // Report Transaksi Penarikan, Pemasangan
    Route::get('reports/transactions/{type}', [Branch_ReportController::class, 'transaction'])->name('reports.transaction');
});
