<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotorcycleOptionalDataRequest;
use App\Models\MotorcycleOptional;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            if ($request->has('showAll') && $request->showAll === "false") {
                $query->where('created_by', Auth::id());
            }
            return $query;
        })->paginate(10);
        return Inertia::render('MotorcycleOptional/List', [
            'optionals' => $optional
        ]);
    }

    public function create(MotorcycleOptionalDataRequest $request): RedirectResponse
    {
        $this->patchOptional($request);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(MotorcycleOptionalDataRequest $request, $id): RedirectResponse
    {
        $optional = MotorcycleOptional::findOrFail($id);
        $this->patchOptional($request, $optional);

        return redirect()->back()->with('success', 'Item editado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $fuelType = MotorcycleOptional::findOrFail($id);
        $fuelType->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function apiGet(Request $request)
    {
        $optional = MotorcycleOptional::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $optional;
    }

    public function apiCreate(Request $request)
    {
        $optional = $this->patchOptional($request);

        return response()->json($optional);
    }

    private function patchOptional(Request $request, MotorcycleOptional $optional = null)
    {
        if (!$optional) {
            $optional = new MotorcycleOptional();
        }

        $optional->name = $request->name;
        $optional->save();

        return $optional;
    }
}
