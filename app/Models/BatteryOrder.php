<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatteryOrder extends Model
{
    use HasFactory;

    protected $table = 'battery_order';

    protected $fillable = [
        'order_id', 'payment_method', 'items', 'subtotal', 'total'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Generate the next order_id in sequence
            $latestOrder = self::latest('id')->first();
            $nextId = $latestOrder ? $latestOrder->id + 1 : 1;
            $order->order_id = 'B-Order' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        });
    }
}
