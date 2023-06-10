<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreProductController;

Route::get('/service_product', [StoreProductController::class, 'index']);
Route::post('/service_product', [StoreProductController::class, 'store'])->name('product.store');
Route::get('/service_product/detail', [StoreProductController::class, 'show'])->name('product.show');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
