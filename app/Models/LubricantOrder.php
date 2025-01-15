<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LubricantOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_type',
        'measurement_type',
        'unit',
        'total_items',
        'all_id',
        'total_price',
        'paid_amount',
        'due_amount',
        'payment_type',
    ];

    /**
     * Get the customer associated with the lubricant order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the lubricant associated with the lubricant order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lubricant()
    {
        return $this->belongsTo(Lubricant::class); // Define the relationship with the Lubricant model
    }
}
