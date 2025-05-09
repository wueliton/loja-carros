<?php

namespace App\Models;

use App\Traits\CreatedBy;
use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MotorcycleImages extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription, CreatedBy;

    public $displayName = 'Imagem de Moto';

    protected $fillable = [
        'url',
        'motorcycle_id',
        'order'
    ];

    public function motorcycles()
    {
        return $this->belongsTo(Motorcycle::class, 'motorcycle_id', 'id');
    }
}
