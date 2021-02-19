<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductSizeStock;
use App\Models\ReturnProduct;
use Illuminate\Http\Response;
class ReturnProductsController extends Controller
{
    public function getReturns(){
    	return view('return_products.return');
    }
    //stockSubmit
    public function returnSubmit(Request $request){
    	//validate
        $validate = Validator::make($request->all(), [
                'product_id'=> 'required|numeric',
                'date'=> 'required|string',
                'items'=> 'required'

               
        ]);

        //error handles
        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        foreach ($request->items as $item) {
        	if($item['quantity'] && $item['quantity'] > 0){
        		$stock_item = new ReturnProduct();
	        	$stock_item->product_id = $request->product_id;
	        	$stock_item->date = $request->date;
	        	$stock_item->size_id = $item['size_id'];
	        	$stock_item->quantity = $item['quantity'];
	        	$stock_item->save();

	        	//set quantity

	        	$psq = ProductSizeStock::where('product_id', $request->product_id)
	        	->where('size_id', $item['size_id'])->first();

	        	// return quantity in
	        	$psq->quantity = $psq->quantity + $item['quantity'];
	        	//update quantity
	        	$psq->save();
        	}
        }

        flash('Return Product updated successfully')->success();

        return response()->json([
        	'success' => true,

        ], Response::HTTP_OK);

    }

    
}
