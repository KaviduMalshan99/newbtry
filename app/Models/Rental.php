<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'old_battery_id',
        'rental_start_date',
        'rental_end_date',
        'actual_return_date',
        'rental_cost',
        'late_return_fee',
        'damage_fee',
        'notes',
        'total_cost',
        'paid_amount',
        'due_amount',
        'payment_type',
        'payment_status',
        'advance_amount',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function oldBattery()
    {
        return $this->belongsTo(OldBattery::class);
    }
}
