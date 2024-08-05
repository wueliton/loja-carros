<?php

namespace App\Models;

use App\Traits\CreatedBy;
use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Motorcycle extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription, SoftDeletes, CreatedBy;

    public $displayName = 'Moto';
    public $displayProperty = 'title';

    protected $fillable = [
        'title',
        'brand_id',
        'model_id',
        'store_id',
        'type_id',
        'manufacturing_year',
        'year',
        'cylinder',
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
        return $this->belongsToMany(MotorcycleOptional::class, 'motorcycle_optionals_relations', 'motorcycle_id', 'motorcycle_optionals_id');
    }

    public function images()
    {
        return $this->hasMany(MotorcycleImages::class, 'motorcycle_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brand_id', 'id');
    }

    public function model()
    {
        return $this->belongsTo(MotorcycleBrandModel::class, 'model_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(MotorcycleTypes::class, 'type_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
}
