<?php

namespace App\Models;

use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CarTransmission extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription;

    public $displayName = 'Tipos de Câmbios';
    public $displayProperty = 'name';

    protected $fillable = [
        'name'
    ];
}