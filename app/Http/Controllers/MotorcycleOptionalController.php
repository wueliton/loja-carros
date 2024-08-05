<?php

namespace App\Http\Controllers;

use App\Models\MotorcycleOptional;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MotorcycleOptionalController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $optional = MotorcycleOptional::latest()->where(function ($query) use ($request) {
            if (!$request->user()->hasRole('admin')) {
                $query->where('created_by', Auth::id());
            }
        })->paginate(10);
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

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $fuelType = MotorcycleOptional::findOrFail($id);
        $fuelType->name = $request->name;
        $fuelType->save();

        return redirect()->back()->with('success', 'Item editado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $fuelType = MotorcycleOptional::findOrFail($id);
        $fuelType->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }
}
