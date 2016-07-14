<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Const
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    //category data
    public function category(){
    	return $this->belongsTo(Category::class); 
    }
    //brand data
    public function brand(){
    	return $this->belongsTo(Brand::class);
    }
    //product size stock
    public function product_size_stock(){
    	return $this->hasMany(ProductSizeStock::class);
    }
}
