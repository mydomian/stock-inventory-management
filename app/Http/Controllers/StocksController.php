<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductStock;
use App\Models\ProductSizeStock;
use Illuminate\Http\Response;
class StocksController extends Controller
{
    public function getProducts(){
    	return view('stocks.stock');
    }
    //stockSubmit
    public function stockSubmit(Request $request){
    	//validate
        $validate = Validator::make($request->all(), [
                'product_id'=> 'required|numeric',
                'date'=> 'required|string',
                'stock_type'=> 'required|string',
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
        		$stock_item = new ProductStock();
	        	$stock_item->product_id = $request->product_id;
	        	$stock_item->date = $request->date;
	        	$stock_item->status = $request->stock_type;
	        	$stock_item->size_id = $item['size_id'];
	        	$stock_item->quantity = $item['quantity'];
	        	$stock_item->save();

	        	//set quantity

	        	$psq = ProductSizeStock::where('product_id', $request->product_id)
	        	->where('size_id', $item['size_id'])->first();

	        	if($request->stock_type == ProductStock::STOCK_IN){
	        		//quantity in
	        		$psq->quantity = $psq->quantity + $item['quantity'];
	        	}
	        	else{
	        		//quantity out
	        		$psq->quantity = $psq->quantity - $item['quantity'];
	        	}

	        	//update quantity
	        	$psq->save();
        	}
        }

        flash('Stock updated successfully')->success();

        return response()->json([
        	'success' => true,

        ], Response::HTTP_OK);

    }

    //stockHistory
    public function history(){
    	$stock_history = ProductStock::with('product', 'size')->orderBy('created_at', 'DESC')->get();
    	return view('stocks.history', compact('stock_history'));
    }
}
