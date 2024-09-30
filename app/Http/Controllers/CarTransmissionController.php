<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarTransmissionDataRequest;
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
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            if ($request->has('showAll') && $request->showAll === "false") {
                $query->where('created_by', Auth::id());
            }
            return $query;
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

    public function create(CarTransmissionDataRequest $request): RedirectResponse
    {
        $this->patchTransmission($request);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(CarTransmissionDataRequest $request, $id): RedirectResponse
    {
        $transmission = CarTransmission::findOrFail($id);
        $this->patchTransmission($request, $transmission);

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $transmission = CarTransmission::findOrFail($id);
        $transmission->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function apiCreate(Request $request)
    {
        $transmission = $this->patchTransmission($request);

        return response()->json($transmission);
    }

    private function patchTransmission(Request $request, CarTransmission $transmission = null)
    {
        if (!$transmission) {
            $transmission = new CarTransmission();
        }

        $transmission->name = $request->name;
        $transmission->save();

        return $transmission;
    }
}
