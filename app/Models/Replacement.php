<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'bought_old_battery_id',
        'old_battery_id',
        'replacement_reason',
        'replacement_date',
        'bought_old_battery_price',
        'bought_old_battery_quantity',
        'new_battery_id',
        'new_battery_price',
        'new_battery_quantity',
        'price_adjustment',
        'battery_discount',
        'old_battery_discount_value',
        'subtotal',
        'total_price',
        'paid_amount',
        'due_amount',
        'payment_type',
        'payment_status',
        'refund_payment_status',
        'notes',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(BatteryOrder::class, 'order_id');
    }

    public function oldBattery()
    {
        return $this->belongsTo(OldBattery::class, 'old_battery_id');
    }

    public function newBattery()
    {
        return $this->belongsTo(Battery::class, 'new_battery_id');
    }
    public function boughtOldBattery()
    {
        return $this->belongsTo(Battery::class, 'bought_old_battery_id');
    }
}