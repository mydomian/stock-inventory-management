<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $products = Product::all();
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
        $image = $request->image;
        $name = Str::random(60). '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/products_image', $name);
        $product->image = $name;
        //product save
        $product->save();

        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
