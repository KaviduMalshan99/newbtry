<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldBattery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'old_battery_type',
        'old_battery_condition',
        'old_battery_value',
        'notes',
    ];

    // Relationship to the Order model (if needed)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
