<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LubricantPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'purchase_id',
        'lubricant_id',
        'supplier_id',
        'purchase_date',
        'quantity_purchased',
        'unit_type',
        'total_cost',
        'payment_status',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($lubricantPurchase) {
            // Generate purchase_id like lp0001, lp0002, etc.
            $lastPurchase = LubricantPurchase::orderBy('id', 'desc')->first();
            $purchaseNumber = $lastPurchase ? (int) substr($lastPurchase->purchase_id, 2) + 1 : 1;
            $lubricantPurchase->purchase_id = 'lp' . str_pad($purchaseNumber, 4, '0', STR_PAD_LEFT);
        });
    }

    public function lubricant()
    {
        return $this->belongsTo(Lubricant::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
