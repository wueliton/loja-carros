<?php

namespace App\Models;

use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Store extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription;

    protected $fillable = [
        'name',
        'logo_url',
        'store_number',
        'email',
        'phone',
        'whatsapp'
    ];

    public $displayName = 'Loja';
    public $displayProperty = 'name';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
