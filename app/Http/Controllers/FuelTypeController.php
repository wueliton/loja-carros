<?php

namespace App\Http\Controllers;

use App\Models\FuelType;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class FuelTypeController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(): Response
    {
        $fuelTypes = FuelType::all();
        return Inertia::render('FuelTypes/List', [
            'fuelTypes' => $fuelTypes
        ]);
    }

    public function get(Request $request)
    {
        $fuelTypes = FuelType::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $fuelTypes;
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|unique:fuel_types'
        ]);

        FuelType::create([
            'name' => $request->name
        ]);

        return Redirect::route('fuelTypes');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|unique:fuel_types'
        ]);

        $fuelType = FuelType::findOrFail($id);
        $fuelType->name = $request->name;
        $fuelType->save();

        return Redirect::route('fuelTypes');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $fuelType = FuelType::findOrFail($id);
        $fuelType->delete();

        return Redirect::route('fuelTypes');
    }
}
