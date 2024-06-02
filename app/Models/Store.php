<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_url',
        'store_number',
        'email',
        'phone',
        'whatsapp'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
