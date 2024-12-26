<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldBattery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_id',
        'old_battery_type',
        'old_battery_condition',
        'old_battery_value',
        'battery_status',
        'notes',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}