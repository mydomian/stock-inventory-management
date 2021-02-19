<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    use HasFactory;

    //product
    public function product(){
    	return $this->belongsTo(Product::class);
    }
    //size
    public function size(){
    	return $this->belongsTo(Size::class);
    }
}
