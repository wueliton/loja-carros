<?php

namespace App\Http\Controllers;

use App\Models\CarOptional;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CarOptionalController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $optional = CarOptional::latest()->where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            if ($request->has('showAll') && $request->showAll === "false") {
                $query->where('created_by', Auth::id());
            }
            return $query;
        })->paginate(10);
        return Inertia::render('CarOptional/List', [
            'optional' => $optional
        ]);
    }

    public function get(Request $request)
    {
        $optional = CarOptional::where(function ($query) use ($request) {
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

        CarOptional::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $fuelType = CarOptional::findOrFail($id);
        $fuelType->name = $request->name;
        $fuelType->save();

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $fuelType = CarOptional::findOrFail($id);
        $fuelType->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }
}
