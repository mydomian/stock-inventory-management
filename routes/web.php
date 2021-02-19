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
use \App\Http\Controllers\StocksController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->group(function(){
    // CATEGORY
    Route::resource('categories', CategoriesController::class);
    Route::get('/api/categories', [CategoriesController::class, 'getCategoriesJson']);
    // Brand
    Route::resource('brands', BrandController::class);
    Route::get('/api/brands', [BrandController::class, 'getBrandsJson']);
    // Size
    Route::resource('sizes', SizesController::class);
    Route::get('/api/sizes', [SizesController::class, 'getSizesJson']);
    // Product
    Route::resource('products', ProductsController::class);
    Route::get('/api/products', [ProductsController::class, 'getProductsJson']);
    //stock
    Route::get('/stocks', [StocksController::class, 'getProducts'])->name('stocks');
    Route::post('/stocks', [StocksController::class, 'stockSubmit'])->name('stockSubmit');
    //stockHistory
    Route::get('/stocks/history', [StocksController::class, 'history'])->name('stockHistory');


    
});