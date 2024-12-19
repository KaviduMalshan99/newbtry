<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',
        'user_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Boot method to automatically generate user_id.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // Generate the next user_id
            $lastUser = self::latest('user_id')->first();
            $nextId = $lastUser ? intval($lastUser->user_id) + 1 : 1;

            // Format as 6-digit string with leading zeros
            $user->user_id = str_pad($nextId, 6, '0', STR_PAD_LEFT);
        });
    }
}
