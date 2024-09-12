<?php

namespace App\Models;

use App\Traits\CreatedBy;
use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use \Illuminate\Support\Str;

class Car extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription, SoftDeletes, CreatedBy;

    public $displayName = 'Carro';
    public $displayProperty = 'title';

    protected $fillable = [
        'title',
        'brand_id',
        'model_id',
        'price',
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
        'slug',
        'visits'
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

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(CarImages::class, 'car_id', 'id');
    }

    public function singleImage()
    {
        return $this->hasOne(CarImages::class, 'car_id', 'id');
    }

    public function optionals()
    {
        return $this->belongsToMany(CarOptional::class, 'car_optionals_relations', 'car_id', 'car_optional_id');
    }

    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);

        $originalSlug = $slug;
        $count = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-" . $count++;
        }

        return $slug;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model->title);
        });
    }
}
