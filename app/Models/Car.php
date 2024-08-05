<?php

namespace App\Models;

use App\Traits\CreatedBy;
use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Car extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription, SoftDeletes, CreatedBy;

    public $displayName = 'Carro';
    public $displayProperty = 'title';

    protected $fillable = [
        'title',
        'brand_id',
        'model_id',
        'store_id',
        'manufacturing_year',
        'year',
        'version',
        'color_id',
        'fuel_type_id',
        'doors',
        'transmission_id',
        'motor',
        'km',
        'last_digit',
        'details',
        'seats',
        'power',
        'size',
        'fuel_capacity',
        'axis_length'
    ];

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brand_id', 'id');
    }

    public function model()
    {
        return $this->belongsTo(CarBrandModel::class, 'model_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function transmission()
    {
        return $this->belongsTo(CarTransmission::class, 'transmission_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(CarImages::class, 'car_id', 'id');
    }

    public function optionals()
    {
        return $this->belongsToMany(CarOptional::class, 'car_optionals_relations', 'car_id', 'car_optional_id');
    }
}
