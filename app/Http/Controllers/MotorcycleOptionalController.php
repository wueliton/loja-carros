<?php

namespace App\Http\Controllers;

use App\Models\MotorcycleOptional;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MotorcycleOptionalController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(): Response
    {
        $optional = MotorcycleOptional::latest()->paginate(10);
        return Inertia::render('MotorcycleOptional/List', [
            'optionals' => $optional
        ]);
    }

    public function get(Request $request)
    {
        $optional = MotorcycleOptional::where(function ($query) use ($request) {
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

        MotorcycleOptional::create([
            'name' => $request->name
        ]);

        return Redirect::route('motorcycleOptional');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $fuelType = MotorcycleOptional::findOrFail($id);
        $fuelType->name = $request->name;
        $fuelType->save();

        return Redirect::route('motorcycleOptional');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $fuelType = MotorcycleOptional::findOrFail($id);
        $fuelType->delete();

        return Redirect::route('motorcycleOptional');
    }
}
