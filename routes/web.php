<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductAjaxController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::resource('products-ajax-crud', ProductAjaxController::class);
Route::resource('product', ProductController::class)->except(['update', 'destroy']);

Route::post('/product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::post('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');