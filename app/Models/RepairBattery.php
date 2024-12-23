<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairBattery extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'brand', 'model_number'];

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
