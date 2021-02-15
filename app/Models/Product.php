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
}
