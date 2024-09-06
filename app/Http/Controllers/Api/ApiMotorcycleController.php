<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MotorcycleBrandModel;
use App\Services\FilterService;
use Illuminate\Http\Request;

class ApiMotorcycleController extends Controller
{
    public function __construct(protected FilterService $filterService) {}

    public function getBrandModels(Request $request)
    {
        $brandModels = MotorcycleBrandModel::where(function ($query) use ($request) {
            if ($request->has("where")) {
                $query = $this->filterService->apply($query, $request->where);
            }
        })->get();

        return response()->json($brandModels);
    }
}
