<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPayment extends Model
{
    use HasFactory;

    protected $table = 'l_payment';

    protected $fillable = [
        'payment_id',
        'product_type',
        'amount',
        'payment_method',
        'discount',
        'status',
        'description',
        'purchase_id', // Add purchase_id to the fillable array
    ];

    public static function generatePaymentId()
    {
        $lastPayment = self::latest('id')->first();
        $id = $lastPayment ? $lastPayment->id + 1 : 1;
        return 'pay' . str_pad($id, 4, '0', STR_PAD_LEFT);
    }

    // Define the relationship with the LubricantPurchase model
    public function lubricantPurchase()
    {
        return $this->belongsTo(LubricantPurchase::class, 'purchase_id');
    }
}


