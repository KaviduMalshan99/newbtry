<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'model_name',        // Name of the battery model
        'brand',             // Battery brand
        'capacity',          // Capacity in Ah
        'voltage',           // Voltage in V
        'type',              // Type of battery (e.g., Lead-Acid, Lithium-ion)
        'warranty_period',   // Warranty period in months
        'purchase_price',    // Price at which the battery was purchased
        'selling_price',     // Price at which the battery is sold
        'manufacturing_date',// Date of manufacturing
        'expiry_date',       // Expiry date, if applicable
        'stock_quantity',    // Current stock quantity
        'added_date',        // Date the battery was added to the system
        // 'supplier_id',       // Foreign key referencing the supplier table
        'image',
    ];

    /**
     * Define the relationship with the Supplier model.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
