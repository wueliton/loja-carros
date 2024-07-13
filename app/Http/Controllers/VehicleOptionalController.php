<?php

namespace App\Http\Controllers;

use App\Models\VehicleOptional;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class VehicleOptionalController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(): Response
    {
        $optional = VehicleOptional::all();
        return Inertia::render('Optional/List', [
            'optional' => $optional
        ]);
    }

    public function get(Request $request)
    {
        $optional = VehicleOptional::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $optional;
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        VehicleOptional::create([
            'name' => $request->name
        ]);

        return Redirect::route('optional');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $fuelType = VehicleOptional::findOrFail($id);
        $fuelType->name = $request->name;
        $fuelType->save();

        return Redirect::route('optional');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $fuelType = VehicleOptional::findOrFail($id);
        $fuelType->delete();

        return Redirect::route('optional');
    }
}
