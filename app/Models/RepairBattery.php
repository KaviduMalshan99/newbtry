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
        'prapered_by_user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'prapered_by_user_id');
    }
}
