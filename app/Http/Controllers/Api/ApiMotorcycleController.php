<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Motorcycle;
use App\Models\MotorcycleBrandModel;
use App\Services\FilterService;
use Illuminate\Http\Request;

class ApiMotorcycleController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function getBrandModels(Request $request)
    {
        $brandModels = MotorcycleBrandModel::where(function ($query) use ($request) {
            if ($request->has("where")) {
                $query = $this->filterService->apply($query, $request->where);
            }
        })->get();

        return response()->json($brandModels);
    }

    public function find(Request $request)
    {
        $motorcycles = Motorcycle::latest()->where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
        })->with('brand', 'singleImage', 'color')->select('id', 'title', 'brand_id', 'price', 'km', 'color_id', 'slug')->paginate(10);

        return response()->json($motorcycles);
    }

    public function getBySlug(Request $request, $slug)
    {
        $motorcycle = Motorcycle::with('brand', 'model', 'color', 'images', 'optionals', 'store')->where('slug', $slug)->first();
        return response()->json($motorcycle);
    }
}
