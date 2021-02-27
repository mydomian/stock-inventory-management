<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductStock;
use App\Models\ReturnProduct;
class DashboardsController extends Controller
{
    public function dshIndex(){
    	$total_product = Product::count();
        $total_user = User::count();
    	$total_size_stock = ProductStock::where('status', ProductStock::STOCK_IN)->count();
        $total_return_product = ReturnProduct::count();
    	$latest_product = Product::latest()->limit(10)->get();

    	return view('deshboard', compact('total_product','total_user','total_size_stock','total_return_product','latest_product'));

    	
	}
}
