<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait CreatedBy
{
    public static function bootCreatedBy()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        static::addFillableCreatedBy();
    }

    protected static function addFillableCreatedBy()
    {
        $model = new static;

        if (!in_array('created_by', $model->getFillable())) {
            $model->fillable[] = 'created_by';
        }
    }
}
