<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'supplier_id',
        'battery_id',
        'lubricant_id',
        'quantity',
        'purchase_price',
    ];
}
