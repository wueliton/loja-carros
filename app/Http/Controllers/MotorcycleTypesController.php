<?php

namespace App\Http\Controllers;

use App\Models\MotorcycleTypes;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MotorcycleTypesController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(): Response
    {
        $motorcycleTypes = MotorcycleTypes::latest()->paginate(10);
        return Inertia::render('MotorcycleTypes/List', [
            'types' => $motorcycleTypes
        ]);
    }

    public function get(Request $request)
    {
        $motorcycleTypes = MotorcycleTypes::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $motorcycleTypes;
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|unique:motorcycle_types'
        ]);

        MotorcycleTypes::create([
            'name' => $request->name
        ]);

        return Redirect::route('motorcycleTypes');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|unique:motorcycle_types'
        ]);

        $motorcycleTypes = MotorcycleTypes::findOrFail($id);
        $motorcycleTypes->name = $request->name;
        $motorcycleTypes->save();

        return Redirect::route('motorcycleTypes');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $motorcycleTypes = MotorcycleTypes::findOrFail($id);
        $motorcycleTypes->delete();

        return Redirect::route('motorcycleTypes');
    }
}
