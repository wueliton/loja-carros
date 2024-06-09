<?php

namespace App\Http\Controllers;

use App\Models\VehicleFuelType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class FuelTypeController extends Controller
{
    public function list(Request $request): Response
    {
        $fuelTypes = VehicleFuelType::all();
        return Inertia::render('FuelTypes/List', [
            'fuelTypes' => $fuelTypes
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        VehicleFuelType::create([
            'name' => $request->name
        ]);

        return Redirect::route('fuelTypes');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $fuelType = VehicleFuelType::findOrFail($id);
        $fuelType->name = $request->name;
        $fuelType->save();

        return Redirect::route('fuelTypes');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $fuelType = VehicleFuelType::findOrFail($id);
        $fuelType->delete();

        return Redirect::route('fuelTypes');
    }
}
