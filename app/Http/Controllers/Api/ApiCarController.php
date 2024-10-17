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

    public function highlights(Request $request)
    {
        $take = $request->has('take') ? $request->take : 4;
        $highlights = Car::select('id', 'title', 'brand_id', 'created_at', 'slug', 'visits', 'color_id', 'km', 'price')->with('singleImage', 'brand', 'color')->orderBy('visits', 'desc')->take($take)->get();
        return response()->json($highlights);
    }

    public function latest(Request $request)
    {
        $take = $request->has('take') ? $request->take : 5;
        $lastCars = Car::select('id', 'title', 'brand_id', 'created_at', 'slug')->with('singleImage', 'brand')->whereHas('singleImage')->take($take)->get();
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
        $car->increment('visits');
        return response()->json($car);
    }

    public function find(Request $request)
    {
        $cars = Car::latest()->where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
        })->with('brand', 'singleImage', 'color', 'model', 'optionals')->select('id', 'title', 'brand_id', 'price', 'year', 'km', 'color_id', 'slug', 'model_id')->orderBy('visits', 'desc')->paginate(10);

        return response()->json($cars);
    }

    public function getByCode(Request $request, $code)
    {
        $car = Car::where('code', '=', $code)->get();
        return response()->json($car);
    }
}
