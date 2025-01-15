<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'battery_id',
        'rental_start_date',
        'rental_end_date',
        'rental_cost',
        'deposit_amount',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function battery()
    {
        return $this->belongsTo(Battery::class);
    }
}
