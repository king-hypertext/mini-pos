<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReturnSaleController;
use App\Http\Controllers\SaleController;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Route;

Route::get('login', [AppController::class, 'login'])->name('login');
Route::post('login', [AppController::class, 'authenticate'])->name('authenticate');
Route::middleware(['auth'])->group(function () {
    Route::get('/', [AppController::class, 'menu'])->name('home');
    Route::get('/products/find', [ProductController::class, 'productExists'])->name('find.product');
    Route::resource('/products', ProductController::class);
    Route::get('/sales/print/{id}', [SaleController::class, 'Print'])->name('sale.print');
    Route::resource('/sales', SaleController::class);
    Route::resource('/returns', ReturnSaleController::class);
    Route::post('/logout', [AppController::class, 'logout'])->name('logout');
    Route::get('settings', [AppController::class, 'viewSettings'])->name('settings');
    Route::post('settings', [AppController::class, 'saveSettings'])->name('settings.save');
});
