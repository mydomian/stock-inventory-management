<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Models\ProductSizeStock;
use App\Models\Product;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category','brand')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validate
        $validate = Validator::make($request->all(), [
                'category_id'=> 'required|numeric',
                'brand_id'=> 'required|numeric',
                'sku'=> 'required|string|max:100|unique:products',
                'name'=> 'required|string|min:2|max:200',
                'image'=> 'required|image|mimes:jpeg,jpg,png|max:1024',
                'cost_price'=> 'required|numeric',
                'retail_price'=> 'required|numeric',
                'year'=> 'required',
                'description'=> 'required|max:200',
                'status'=> 'required|numeric'
        ]);

        //error handles
        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        $product = new Product();
        $product->user_id = Auth::id();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->cost_price = $request->cost_price;
        $product->retail_price = $request->retail_price;
        $product->year = $request->year;
        $product->description = $request->description;
        $product->status = $request->status;

        //upload image
        if($request->hasFile('image')){
            $image = $request->image;
            $name = Str::random(60). '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products_image', $name);
            $product->image = $name;
        }
        //product save
        $product->save();


        //Product Size Stock(items)
        if($request->items){
            foreach (json_decode($request->items) as $item) {
                $size_stock = new ProductSizeStock();
                $size_stock->product_id = $product->id;
                $size_stock->size_id =$item->size_id;
                $size_stock->location = $item->location;
                $size_stock->quantity = $item->quantity;
                //product size stock save
                $size_stock->save();
            }
        } 

        flash('Product Created Successfully')->success();

        return response()->json([
                'success' => true
            ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category','brand','product_size_stock.size')->where('id', $id)
            ->first();
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('product_size_stock')->where('id', $id)->first();
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate
        $validate = Validator::make($request->all(), [
                'category_id'=> 'required|numeric',
                'brand_id'=> 'required|numeric',
                'sku'=> 'required|string|max:100|unique:products,sku,'.$id,
                'name'=> 'required|string|min:2|max:200',
                'image'=> 'nullable|image|mimes:jpeg,jpg,png|max:1024',
                'cost_price'=> 'required|numeric',
                'retail_price'=> 'required|numeric',
                'year'=> 'required',
                'description'=> 'required|max:200',
                'status'=> 'required|numeric'
        ]);

        //error handles
        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        $product = Product::findOrFail($id);
        $product->user_id = Auth::id();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->cost_price = $request->cost_price;
        $product->retail_price = $request->retail_price;
        $product->year = $request->year;
        $product->description = $request->description;
        $product->status = $request->status;

        //upload image
        if($request->hasFile('image')){
            $image = $request->image;
            $name = Str::random(60). '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products_image', $name);
            $product->image = $name;
        }
        //product save
        $product->save();

        //delete items old data
        ProductSizeStock::where('product_id', $id)->delete();
        //Product Size Stock(items)
        if($request->items){
            foreach (json_decode($request->items) as $item) {
                $size_stock = new ProductSizeStock();
                $size_stock->product_id = $product->id;
                $size_stock->size_id =$item->size_id;
                $size_stock->location = $item->location;
                $size_stock->quantity = $item->quantity;
                //product size stock save
                $size_stock->save();
            }
        } 

        flash("Product Updated Successfully")->success();

        return response()->json([
                'success' => true
            ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        //flash message
        flash('Product deleted successfully')->success();
        return back();

    }
}
