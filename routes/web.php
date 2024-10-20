<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.menu');
})->name('home');
Route::get('/products/find', [ProductController::class, 'productExists'])->name('find.product');
Route::resource('/products', ProductController::class);
// Route::resource('/order', SaleController::class);
Route::get('/sales/print/{id}', [SaleController::class, 'Print'])->name('sale.print');
Route::resource('/sales', SaleController::class);
Route::get('/logout', function () {})->name('logout');
