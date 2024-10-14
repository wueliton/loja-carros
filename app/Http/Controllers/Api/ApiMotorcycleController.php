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
        })->with('brand', 'singleImage', 'color', 'model')->select('id', 'title', 'brand_id', 'price', 'km', 'color_id', 'slug', 'model_id', 'type_id')->paginate(10);

        return response()->json($motorcycles);
    }

    public function getBySlug(Request $request, $slug)
    {
        $motorcycle = Motorcycle::with('brand', 'model', 'color', 'images', 'optionals', 'store')->where('slug', $slug)->first();
        $motorcycle->increment('visits');
        return response()->json($motorcycle);
    }

    public function getByCode(Request $request, $code)
    {
        $motorcycle = Motorcycle::where('code', '=', $code)->get();
        return response()->json($motorcycle);
    }
}
