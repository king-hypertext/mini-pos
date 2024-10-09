<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.menu');
})->name('home');
Route::get('/products/find', [ProductController::class, 'productExists'])->name('find.product');
Route::resource('/products', ProductController::class);
Route::get('/logout', function () {})->name('logout');
