<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lubricant extends Model
{
    use HasFactory;

    // Specify which attributes can be mass-assigned
    protected $fillable = [
        'name', // Add 'name' here
        'brand',
        'purchase_price',
        'sale_price',
        'stock_quantity',
        'unit',
    ];

    // Optional: If you have timestamps, you can enable them like this
    public $timestamps = true;
}
