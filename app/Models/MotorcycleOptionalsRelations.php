<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorcycleOptionalsRelations extends Model
{
    use HasFactory;

    protected $fillable = [
        'motorcycle_id',
        'motorcycle_optionals_id'
    ];
}
