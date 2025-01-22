<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'prapered_by_user_id',
        'last_name',
        'phone_number',
        'email',
        'address',
        'purchase_history',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'purchase_history' => 'array',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'prapered_by_user_id');
    }
}
