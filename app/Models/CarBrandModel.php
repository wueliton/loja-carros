<?php

namespace App\Models;

use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CarBrandModel extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription;

    public $displayName = 'Modelo de carro';
    public $displayProperty = 'name';

    protected $fillable = [
        'name',
        'brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brands::class);
    }
}
