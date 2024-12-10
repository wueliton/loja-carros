<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $isSuperAdmin = $request->user()->hasRole('super');

        $route = $isSuperAdmin ? 'Super/Dashboard/index' : 'User/Dashboard/index';
        $storeId = $request->user()->lastStoreId();
        $activities = Activity::where('causer_id', Auth::id())->latest()->take(5)->get();
        $store = Store::find($storeId);

        Log::warning("{$storeId}");

        if (!isset($store)) {
            return Inertia::render($route, [
                'logs' => $activities,
                'store' => null,
            ]);
        }


        $registeredCars = Car::where('store_id', $storeId)->count();
        $moreVisitedCars = Car::where('store_id', $storeId)->select('id', 'title', 'slug', 'visits')->orderBy('visits', 'desc')->limit(5)->get();
        $registeredMotorcycles = Motorcycle::where('store_id', $storeId)->count();
        $moreVisitedMotorcycles = Motorcycle::where('store_id', $storeId)->select('id', 'title', 'slug', 'visits')->orderBy('visits', 'desc')->limit(5)->get();

        return Inertia::render($route, [
            'logs' => $activities,
            'store' => $store,
            'cars' => [
                'registerCount' => $registeredCars,
                'moreVisited' => $moreVisitedCars,
                'limit' => $store->max_motorcycles,
            ],
            'motorcycles' => [
                'registerCount' => $registeredMotorcycles,
                'moreVisited' => $moreVisitedMotorcycles,
                'limit' => $store->max_motorcycles,
            ]
        ]);
    }
}
