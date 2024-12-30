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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($rental) {
            $rental->public_id = self::generateUniquePublicId();
        });
    }

    public static function generateUniquePublicId()
    {
        do {
            $publicId = strtoupper(substr(bin2hex(random_bytes(3)), 0, 5)); // Generates a 5-character unique ID
        } while (self::where('public_id', $publicId)->exists());

        return $publicId;
    }
}
