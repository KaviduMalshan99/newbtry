<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatteryModelNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'battery_id',
        'model_number',
        'is_active',
        'battery_order_id',
        'battery_purchase_id',
    ];

    public function battery()
    {
        return $this->belongsTo(Battery::class);
    }

    public function batteryOrder()
    {
        return $this->belongsTo(BatteryOrder::class);
    }

    public function batteryPurchase()
    {
        return $this->belongsTo(BatteryPurchase::class);
    }
}