<?php

namespace App\Models;

use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CarImages extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription;

    public $displayName = 'Imagem de Carro';

    protected $fillable = [
        'url',
        'car_id'
    ];

    public function cars()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
}
