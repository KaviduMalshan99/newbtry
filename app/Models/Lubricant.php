<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lubricant extends Model
{
    use HasFactory;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'name', 
        'brand_id', 
        'purchase_price', 
        'sale_price', 
        'stock_quantity', 
        'unit', 
        'volume', 
        'total_count',
        'type', 
        'image',
    ];

    /**
     * Get the brand associated with the lubricant.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class); // Define the relationship with the Brand model
    }
}
