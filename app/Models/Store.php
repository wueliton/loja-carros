<?php

namespace App\Models;

use App\Traits\CreatedBy;
use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use \Illuminate\Support\Str;

class Store extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription, SoftDeletes, CreatedBy;

    protected $fillable = [
        'name',
        'logo_url',
        'store_number',
        'email',
        'phone',
        'whatsapp',
        'instagram',
        'facebook',
        'site',
        'slug',
        'max_motorcycles',
        'max_cars'
    ];

    public $displayName = 'Loja';
    public $displayProperty = 'name';

    public function users()
    {
        return $this->belongsToMany(User::class, 'store_users');
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'store_id', 'id');
    }

    public function motorcycles()
    {
        return $this->hasMany(Motorcycle::class);
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
            $model->slug = $model->generateUniqueSlug($model->name);
        });

        static::deleting(function ($model) {
            $model->cars()->delete();
            $model->motorcycles()->delete();
        });
    }
}
