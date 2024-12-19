<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'battery_ids',
        'lubricant_ids',
        'quantity',
        'sale_price',
        'discount',
        'payment_method',
    ];

    protected $casts = [
        'battery_ids' => 'array',
        'lubricant_ids' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function batteries()
    {
        return $this->belongsToMany(Battery::class, 'battery_sales', 'sale_id', 'battery_id');
    }

    public function lubricants()
    {
        return $this->belongsToMany(Lubricant::class, 'lubricant_sales', 'sale_id', 'lubricant_id');
    }
}
