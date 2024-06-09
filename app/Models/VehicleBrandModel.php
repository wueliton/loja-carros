<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBrandModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo(VehicleBrands::class);
    }
}
