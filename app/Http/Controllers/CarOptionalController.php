<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarOptionalDataRequest;
use App\Models\CarOptional;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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

    public function create(CarOptionalDataRequest $request): RedirectResponse
    {
        $this->patchOptional($request);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(CarOptionalDataRequest $request, $id): RedirectResponse
    {
        $fuelType = CarOptional::findOrFail($id);
        $this->patchOptional($request, $fuelType);

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $fuelType = CarOptional::findOrFail($id);
        $fuelType->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function apiGet(Request $request)
    {
        $optional = CarOptional::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $optional;
    }

    function apiCreate(CarOptionalDataRequest $request)
    {
        $optional = $this->patchOptional($request);

        return response()->json($optional);
    }

    public function patchOptional(Request $request, CarOptional $optional = null)
    {
        if (!$optional) {
            $optional = new CarOptional();
        }

        $optional->name = $request->name;
        $optional->save();

        return $optional;
    }
}
