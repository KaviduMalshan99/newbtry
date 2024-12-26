<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatteryPurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'battery_purchase_id',
        'supplier_id',
        'battery_id',
        'quantity',
        'purchase_price',
    ];

    public function product()
    {
        return $this->morphTo(); // Use polymorphic relationships for batteries and lubricants
    }

    public function battery()
    {
        return $this->belongsTo(Battery::class);
    }

    public function batteryPurchase()
    {
        return $this->belongsTo(BatteryPurchase::class, 'battery_purchase_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
