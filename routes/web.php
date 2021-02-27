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
use \App\Http\Controllers\DashboardsController;
use \App\Http\Controllers\UsersController;
use \App\Http\Controllers\CategoriesController;
use \App\Http\Controllers\BrandController;
use \App\Http\Controllers\SizesController;
use \App\Http\Controllers\ProductsController;
use \App\Http\Controllers\StocksController;
use \App\Http\Controllers\ReturnProductsController;


Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth:sanctum'])->group(function(){
    //Dashboar
    Route::get('/dashboard', [DashboardsController::class, 'dshIndex'])->name('dashboard');
    //User
    Route::resource('users', UsersController::class);
    // Category
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
    Route::get('/stocks/history', [StocksController::class, 'history'])->name('stockHistory');
    //Return Product
    Route::get('/return-products', [ReturnProductsController::class, 'getReturns'])->name('return');
    Route::post('/return-products', [ReturnProductsController::class, 'returnSubmit'])->name('returnSubmit');
    Route::get('/return-products/history', [ReturnProductsController::class, 'history'])->name('returnHistory');

    
});