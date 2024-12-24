<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'repair_battery_id',
        'repair_order_start_date',
        'repair_order_end_date',
        'diagnostic_report',
        'items_used',
        'repair_cost',
        'labor_charges',
        'total_cost',
        'repair_status',
        'delivery_status',
        'notes'
    ];

    protected $casts = [
        'items_used' => 'array',
    ];

    public function repairBattery()
    {
        return $this->belongsTo(RepairBattery::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
