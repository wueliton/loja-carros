<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\Store;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiStoresController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function getBySlug(Request $request, $slug)
    {
        $store = Store::where("slug", $slug)->first();
        return response()->json($store);
    }

    public function getAds(Request $request, $id)
    {
        $motorcycles = Motorcycle::with('color', 'singleImage')->select('id', 'title', 'color_id', 'km', 'price', 'slug', DB::raw("'motorcycles' as type"))->where('store_id', $id);
        $cars = Car::with('color', 'singleImage')->select('id', 'title', 'color_id', 'km', 'price', 'slug', DB::raw("'cars' as type"))->where('store_id', $id)->union($motorcycles);
        $results = $cars->paginate();
        return response()->json($results);
    }

    public function find(Request $request)
    {
        $stores = Store::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->inRandomOrder()->get();
        return response()->json([
            'data' => $stores,
            'total' => count($stores)
        ]);
    }
}
