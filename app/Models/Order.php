<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'battery_id',
        'order_type',
        'order_date',
        'quantity',
        'total_price',
        'old_battery_discount',
        'payment_status',
        'order_status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function battery()
    {
        return $this->belongsTo(Battery::class);
    }

    public function oldBattery()
    {
        return $this->hasOne(OldBattery::class);
    }
}