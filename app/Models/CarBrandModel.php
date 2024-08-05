<?php

namespace App\Models;

use App\Traits\CreatedBy;
use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class CarBrandModel extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription, SoftDeletes, CreatedBy;

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
