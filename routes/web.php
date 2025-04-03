<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('products', ProductController::class);
// http://127.0.0.1:8000/products/2/edit ,
// Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit')