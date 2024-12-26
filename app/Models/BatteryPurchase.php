<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatteryPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'total_price',
        'paid_amount',
        'due_amount',
        'payment_type',
        'payment_status',
    ];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function batteryPurchaseItems()
    {
        return $this->hasMany(BatteryPurchaseItem::class);
    }
}