<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class FilterService
{
    public function apply(Builder $query, array $where)
    {
        $query->where(function ($query) use ($where) {
            foreach ($where as $index => $condition) {
                if (strpos($condition['fieldName'], '.') !== false) {
                    $path = explode('.', $condition['fieldName']);

                    if ($index === 0) {
                        $query->whereHas($path[0], function ($query) use ($path, $condition) {
                            $this->addCondition($query, $condition, $path[1]);
                        });
                    } else {
                        $query->orWhereHas($path[0], function ($query) use ($path, $condition) {
                            $this->addCondition($query, $condition, $path[1]);
                        });
                    }
                } else {
                    if ($index === 0) {
                        $this->addCondition($query, $condition, $condition['fieldName']);
                    } else {
                        $query->orWhere(function ($query) use ($condition) {
                            $this->addCondition($query, $condition, $condition['fieldName']);
                        });
                    }
                }
            }
        });

        return $query;
    }

    public function addCondition(Builder $query, $condition, $fieldName, $operation = 'null')
    {
        if ($condition['comparison'] === 'contains') {
            $query->where($fieldName, 'LIKE', "%{$condition['value']}%");
        } else if ($condition['comparison'] === 'equals') {
            $query->where($fieldName, $condition['value']);
        } else if ($condition['comparison'] === 'ninq' && array_key_exists('value', $condition)) {
            $query->whereNotIn($fieldName, $condition['value']);
        } else if ($condition['comparison'] === 'inq' && array_key_exists('value', $condition)) {
            $query->whereNotIn($fieldName, $condition['value']);
        }
    }
}
