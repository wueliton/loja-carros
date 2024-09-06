<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarBrandModel;
use App\Services\FilterService;
use Illuminate\Http\Request;

class ApiCarController extends Controller
{
    public function __construct(protected FilterService $filterService) {}

    public function highlights()
    {
        $lastCars = Car::latest()->select('id', 'title', 'brand_id', 'created_at')->with('singleImage', 'brand')->take(3)->get();
        return response()->json($lastCars);
    }

    public function getBrandModels(Request $request)
    {
        $brandModels = CarBrandModel::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
        })->get();

        return response()->json($brandModels);
    }

    public function getById(Request $request, $id)
    {
        $car = Car::with('brand', 'model', 'color', 'transmission', 'images', 'optionals', 'fuelType', 'store')->findOrFail($id);
        return response()->json($car);
    }
}
