<?php

use Illuminate\Support\Facades\Route;

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
use \App\Http\Controllers\CategoriesController;
use \App\Http\Controllers\BrandController;
use \App\Http\Controllers\SizesController;
use \App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->group(function(){
    // CATEGORY
    Route::resource('categories', CategoriesController::class);
    // Brand
    Route::resource('brands', BrandController::class);
    // Size
    Route::resource('sizes', SizesController::class);
    // Product
    Route::resource('products', ProductsController::class);
    
});