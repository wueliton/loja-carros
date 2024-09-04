<?php

namespace App\QueryBuilder;

use App\Services\FilterService;
use Illuminate\Http\Request;

class QueryBuilder
{
    protected $model;
    protected $query;

    public static function for($model)
    {
        $instance = new static;
        $instance->model = $model;
        $instance->query = $model::query();
        return $instance;
    }

    public function filters(Request $request)
    {
        if ($request->has('where')) {
            $filterService = new FilterService();
            $this->query->where(function ($query) use ($request, $filterService) {
                $query = $filterService->apply($query, $request->where);
            });
        }

        return $this->query;
    }
}
