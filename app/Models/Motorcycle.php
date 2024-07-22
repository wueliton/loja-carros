<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'brand_id',
        'model_id',
        'type_id',
        'manufacturing_year',
        'year',
        'cilynder',
        'motor',
        'color_id',
        'km',
        'fuel_capacity',
        'size',
        'axis_length',
        'details'
    ];

    public function optionals()
    {
        return $this->belongsToMany(MotorcycleOptionalsRelations::class, 'motorcycle_optionals_relations', 'motorcycle_id', 'motorcycle_optionals_id');
    }

    public function images()
    {
        return $this->hasMany(MotorcycleImages::class, 'motorcycle_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class);
    }

    public function model()
    {
        return $this->belongsTo(MotorcycleBrandModel::class);
    }

    public function type()
    {
        return $this->belongsTo(MotorcycleTypes::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
