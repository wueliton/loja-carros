<?php

namespace App\Http\Controllers;

use App\Models\VehicleBrands;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class BrandController extends Controller
{
    protected $filter;

    public function __construct(FilterService $filterService)
    {
        $this->filter = $filterService;
    }

    public function list(Request $request): Response
    {
        $brands = VehicleBrands::all();
        return Inertia::render('Brands/List', [
            'brands' => $brands
        ]);
    }

    public function get(Request $request)
    {
        $brands = VehicleBrands::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filter->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $brands;
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:vehicle_brands|string'
        ]);

        VehicleBrands::create([
            'name' => $request->name
        ]);

        return Redirect::route('brands');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|exists:vehicle_brands|string'
        ]);

        $fuelType = VehicleBrands::findOrFail($id);
        $fuelType->name = $request->name;
        $fuelType->save();

        return Redirect::route('brands');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $fuelType = VehicleBrands::findOrFail($id);
        $fuelType->delete();

        return Redirect::route('brands');
    }
}
