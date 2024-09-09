<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarBrandModel;
use App\Services\FilterService;
use Illuminate\Http\Request;

class ApiCarController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function highlights()
    {
        $lastCars = Car::latest()->select('id', 'title', 'brand_id', 'created_at', 'slug')->with('singleImage', 'brand')->take(3)->get();
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

    public function getBySlug(Request $request, $slug)
    {
        $car = Car::with('brand', 'model', 'color', 'transmission', 'images', 'optionals', 'fuelType', 'store')->where('slug', $slug)->first();
        return response()->json($car);
    }

    public function find(Request $request)
    {
        $cars = Car::latest()->where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
        })->with('brand', 'singleImage', 'color')->select('id', 'title', 'brand_id', 'price', 'year', 'km', 'color_id', 'slug')->paginate(10);

        return response()->json($cars);
    }
}
