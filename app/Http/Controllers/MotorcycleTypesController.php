<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotorcycleTypeDataRequest;
use App\Models\MotorcycleTypes;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            if ($request->has('showAll') && $request->showAll === "false") {
                $query->where('created_by', Auth::id());
            }
            return $query;
        })->paginate(10);
        return Inertia::render('Admin/Moto/Types/List', [
            'types' => $motorcycleTypes
        ]);
    }

    public function create(MotorcycleTypeDataRequest $request): RedirectResponse
    {
        $this->patchType($request);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(MotorcycleTypeDataRequest $request, $id): RedirectResponse
    {
        $type = MotorcycleTypes::findOrFail($id);
        $this->patchType($request, $type);

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $motorcycleTypes = MotorcycleTypes::findOrFail($id);
        $motorcycleTypes->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function apiGet(Request $request)
    {
        $motorcycleTypes = MotorcycleTypes::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $motorcycleTypes;
    }

    public function apiCreate(MotorcycleTypeDataRequest $request)
    {
        $type = $this->patchType($request);

        return response()->json($type);
    }

    private function patchType(Request $request, MotorcycleTypes $type = null)
    {
        if (!$type) {
            $type = new MotorcycleTypes();
        }

        $type->name = $request->name;
        $type->save();
        return $type;
    }
}
