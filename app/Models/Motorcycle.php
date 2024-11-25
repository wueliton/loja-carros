<?php

namespace App\Models;

use App\Traits\CreatedBy;
use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use \Illuminate\Support\Str;

class Motorcycle extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription, SoftDeletes, CreatedBy;

    protected $casts = [
        "price" => "decimal:2"
    ];

    public $displayName = 'Moto';
    public $displayProperty = 'title';

    protected $fillable = [
        'title',
        'brand_id',
        'model_id',
        'price',
        'store_id',
        'type_id',
        'manufacturing_year',
        'year',
        'cylinder',
        'motor',
        'color_id',
        'km',
        'details',
        'slug',
        'visits'
    ];

    public function optionals()
    {
        return $this->belongsToMany(MotorcycleOptional::class, 'motorcycle_optionals_relations', 'motorcycle_id', 'motorcycle_optionals_id');
    }

    public function images()
    {
        return $this->hasMany(MotorcycleImages::class, 'motorcycle_id', 'id');
    }

    public function singleImage()
    {
        return $this->hasOne(MotorcycleImages::class, 'motorcycle_id', 'id');
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

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
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

        static::created(function ($model) {
            $model->code = $model->id . date('Y');
            $model->saveQuietly();
        });
    }
}
