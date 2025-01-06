<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LubricantOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'order_id',
        // 'c_phone_number',
        // 'payment_method',
        // 'items',
        // 'subtotal',
        // 'total',

        'order_id', 'payment_method', 'items', 'subtotal', 'total'
    ];
}
