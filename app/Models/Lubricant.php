<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lubricant extends Model
{
    use HasFactory;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'name',
        'brand_id',
        'purchase_price',
        'sale_price',
        'stock_quantity',
        'unit',
        'volume',
        'total_count',
        'type',
        'image',
        'model_no', // Added model_no to handle unique codes like D00001, B00001, etc.
    ];

    /**
     * Get the brand associated with the lubricant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id'); // Define the relationship with the Brand model
    }

    /**
     * Generate a unique model number based on the type of lubricant.
     *
     * @param string $type
     * @return string
     */
    public static function generateModelNo($type)
    {
        $prefix = match (strtolower($type)) {
            'drum' => 'D',
            'bottle' => 'B',
            'ml liter', 'liter' => 'ML',
            default => 'U', // Unknown type
        };

        $latestModel = self::where('type', $type)->latest('id')->first();
        $nextNumber = $latestModel ? ((int) substr($latestModel->model_no, 1)) + 1 : 1;

        return $prefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }
}
