<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'total_price',
    ];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

public function purchaseItems()
{
    return $this->hasMany(PurchaseItem::class);
}

}
