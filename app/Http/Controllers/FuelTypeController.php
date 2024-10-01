<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuelTypeDataRequest;
use App\Models\FuelType;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class FuelTypeController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $fuelTypes = FuelType::latest()->where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            if ($request->has('showAll') && $request->showAll === "false") {
                $query->where('created_by', Auth::id());
            }
            return $query;
        })->paginate(10);
        return Inertia::render('FuelTypes/List', [
            'fuelTypes' => $fuelTypes
        ]);
    }

    public function create(FuelTypeDataRequest $request): RedirectResponse
    {
        $this->patchFuelType($request);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(FuelTypeDataRequest $request, $id): RedirectResponse
    {
        $fuelType = FuelType::findOrFail($id);
        $this->patchFuelType($request, $fuelType);

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $fuelType = FuelType::findOrFail($id);
        $fuelType->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function apiGet(Request $request)
    {
        $fuelTypes = FuelType::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $fuelTypes;
    }

    public function apiCreate(FuelTypeDataRequest $request)
    {
        $fuelType = $this->patchFuelType($request);

        return response()->json($fuelType);
    }

    private function patchFuelType(Request $request, FuelType $fuelType = null)
    {
        if (!$fuelType) {
            $fuelType = new FuelType();
        }

        $fuelType->name = $request->name;
        $fuelType->save();

        return $fuelType;
    }
}
