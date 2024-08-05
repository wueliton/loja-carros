<?php

namespace App\Models;

use App\Traits\CreatedBy;
use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Store extends Model
{
    use HasFactory, LogsActivity, LogsActivityWithDescription, SoftDeletes, CreatedBy;

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
        return $this->belongsToMany(User::class, table: 'store_users');
    }
}
