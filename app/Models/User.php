<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\CreatedBy;
use App\Traits\LogsActivityWithDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, LogsActivity, LogsActivityWithDescription, SoftDeletes, CreatedBy;
    use HasRoles;

    public $displayName = 'Usuário';
    public $displayProperty = 'name';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_users');
    }

    public function lastStore()
    {
        return $this->hasOne(LastStore::class);
    }

    public function lastStoreId()
    {
        return $this->lastStore()->pluck('store_id')->first();
    }
}
