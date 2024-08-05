<?php

namespace App\Http\Controllers;

use App\Models\CarTransmission;
use App\Services\FilterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;

class CarTransmissionController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $transmissions = CarTransmission::latest()->where(function ($query) use ($request) {
            if (!$request->user()->hasRole('admin')) {
                $query->where('created_by', Auth::id());
            }
        })->paginate(10);

        return Inertia::render('CarTransmissions/List', [
            'transmissions' => $transmissions
        ]);
    }

    public function get(Request $request)
    {
        $transmissions = CarTransmission::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $transmissions;
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        CarTransmission::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $transmission = CarTransmission::findOrFail($id);
        $transmission->name = $request->name;
        $transmission->save();

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $transmission = CarTransmission::findOrFail($id);
        $transmission->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }
}
