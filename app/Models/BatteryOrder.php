<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatteryOrder extends Model
{
    use HasFactory;

    protected $table = 'battery_orders';

    protected $fillable = [
        'order_id',
        'customer_id',
        'order_type',
        'order_date',
        'items',
        'battery_discount',
        'subtotal',
        'total_price',
        'paid_amount',
        'due_amount',
        'payment_type',
        'payment_status'

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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function battery()
    {
        return $this->belongsTo(Battery::class);
    }
}