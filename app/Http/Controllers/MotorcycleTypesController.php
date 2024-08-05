<?php

namespace App\Http\Controllers;

use App\Models\MotorcycleTypes;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MotorcycleTypesController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $motorcycleTypes = MotorcycleTypes::latest()->where(function ($query) use ($request) {
            if (!$request->user()->hasRole('admin')) {
                $query->where('created_by', Auth::id());
            }
        })->paginate(10);
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
            'name' => 'required|string'
        ]);

        MotorcycleTypes::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $motorcycleTypes = MotorcycleTypes::findOrFail($id);
        $motorcycleTypes->name = $request->name;
        $motorcycleTypes->save();

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $motorcycleTypes = MotorcycleTypes::findOrFail($id);
        $motorcycleTypes->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }
}
