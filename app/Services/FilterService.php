<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class FilterService
{
    public function apply(Builder $query, array $where)
    {
        foreach ($where as $condition) {
            if ($condition['comparison'] === 'contains') {
                $query->where($condition['fieldName'], 'LIKE', "%{$condition['value']}%");
            } else if ($condition['comparison'] === 'equals') {
                $query->where($condition['fieldName'], $condition['value']);
            } else if ($condition['comparison'] === 'ninq' && array_key_exists('value', $condition)) {
                $query->whereNotIn($condition['fieldName'], $condition['value']);
            } else if ($condition['comparison'] === 'inq' && array_key_exists('value', $condition)) {
                $query->whereIn($condition['fieldName'], $condition['value']);
            }
        }

        return $query;
    }
}
