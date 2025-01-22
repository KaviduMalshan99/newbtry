<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'supplier_id',
        'battery_id',
        'lubricant_id',
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

    public function lubricant()
    {
        return $this->belongsTo(Lubricant::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
