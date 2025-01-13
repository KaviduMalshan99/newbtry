<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairBattery extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'brand_id',
        'model_number',
        'purchase_price',
        'selling_price',
        'isForSelling',
        'added_date',
        'stock_quantity'
    ];

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}