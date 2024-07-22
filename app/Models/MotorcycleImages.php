<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorcycleImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'motorcycle_id'
    ];

    public function motorcycles()
    {
        return $this->belongsTo(Motorcycle::class, 'motorcycle_id', 'id');
    }
}
