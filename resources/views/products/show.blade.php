@extends('layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Product Show</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product show</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
           <div class="row">
	           	<div class="col-sm-6">
	           		<div class="card card-primary card-outline">
	                    <div class="card-body">
	                        <h5 class="card-title">Product info</h5><br><br>

	                       <table class="table table-sm table-bordered">
	                       		<tr>
	                       			<td>Product name</td>
	                       			<td>{{ $product->name ?? '' }}</td>
	                       		</tr>
	                       		<tr>
	                       			<td>Category</td>
	                       			<td>{{ $product->category->name ?? '' }}</td>
	                       		</tr>
	                       		<tr>
	                       			<td>Brand</td>
	                       			<td>{{ $product->brand->name ?? '' }}</td>
	                       		</tr>
	                       		<tr>
	                       			<td>Sku</td>
	                       			<td>{{ $product->sku ?? ''}}</td>
	                       		</tr>
	                       		<tr>
	                       			<td>Cost price($)</td>
	                       			<td>{{ $product->cost_price ?? ''}}</td>
	                       		</tr>
	                       		<tr>
	                       			<td>Retail Price($)</td>
	                       			<td>{{ $product->retail_price ?? ''}}</td>
	                       		</tr>
	                       		<tr>
	                       			<td>Year</td>
	                       			<td>{{ $product->year ?? ''}}</td>
	                       		</tr>
	                       		<tr>
	                       			<td>Description</td>
	                       			<td>{{ $product->description ?? ''}}</td>
	                       		</tr>
	                       		<tr>
	                       			<td>Status</td>
	                       			<td>{{ $product->status ? 'Active' : 'Inactive'}}</td>
	                       		</tr>

	                       </table>

	                    </div>
	                    <div class="card-footer">
	                    	<a href="{{ route('products.index') }}" class="btn btn-sm btn-dark"> <i class="fa fa-arrow-left"> </i>Back</a>
	                    </div>
	                 </div><!-- /.card -->
	           </div>
	           <div class="col-sm-6">
	           		<div class="card card-primary card-outline">
	                    <div class="card-body">
	                        <h5 class="card-title">Image</h5><br><br>

	                       <div class="text-center">
	                       		<img width="250px" height="150px" src="{{ asset('storage/products_image/'. $product->image) }}" alt="Image">
	                       </div>

	                    </div>
	                 </div><!-- /.card -->

	                 <div class="card card-primary card-outline">
	                    <div class="card-body">
	                        <h5 class="card-title">Product stock</h5><br><br>
	                        	{{-- Product Size --}}
		                       <div>
		                       		<table class="table table-sm table-bordered">
		                       			@foreach($product->product_size_stock as $p_stock)

		                       			@endforeach
		                       			<tr>
		                       				<td>{{ $p_stock->size->size }}</td>
		                       				<td>{{ $p_stock->location }}</td>
		                       				<td>{{ $p_stock->quantity }}</td>
		                       			</tr>
		                       		</table>
		                       </div>
	                      

	                    </div>
	                 </div><!-- /.card -->
           </div>
           </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
 