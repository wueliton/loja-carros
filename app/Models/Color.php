<?php

namespace App\Models;

use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Color extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription;

    public $displayName = 'Cor';
    public $displayProperty = 'color';

    protected $fillable = [
        'color'
    ];
}