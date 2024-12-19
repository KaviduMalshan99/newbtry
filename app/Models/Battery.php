<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battery extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'brand',
        'model_number',
        'purchase_price',
        'sale_price',
        'stock_quantity',
        'rental_price_per_day',
        'image_path',
    ];
}
