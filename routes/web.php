<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Auth;

// --- FRONTEND ROUTES ---
Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/product/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

// --- AUTH ROUTES ---
Auth::routes();

// --- CUSTOMER ROUTES (Harus Login) ---
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Keranjang Belanja
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
    
    // Checkout
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
    
    // Pesanan
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'history'])->name('order.history');
});

// --- ADMIN ROUTES (Harus Login & Role Admin) ---
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('product', ProductController::class)->names('admin.product');
    Route::resource('category', CategoryController::class)->names('admin.category');
    
    // Order Management
    Route::get('orders', [App\Http\Controllers\Admin\OrderManagementController::class, 'index'])->name('admin.order.index');
    Route::get('orders/{id}', [App\Http\Controllers\Admin\OrderManagementController::class, 'show'])->name('admin.order.show');
    Route::put('orders/{id}/status', [App\Http\Controllers\Admin\OrderManagementController::class, 'updateStatus'])->name('admin.order.status');

    // Sales Reports
    Route::get('reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.report.index');
    Route::get('reports/export-csv', [App\Http\Controllers\Admin\ReportController::class, 'exportCsv'])->name('admin.report.export-csv');
    Route::get('reports/print', [App\Http\Controllers\Admin\ReportController::class, 'printReport'])->name('admin.report.print');
});
