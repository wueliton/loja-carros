<?php

namespace App\Http\Controllers;

use App\Models\CarBrandModel;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CarBrandModelController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $models = CarBrandModel::with('brand')->where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            if ($request->has('showAll') && $request->showAll === "false") {
                $query->where('created_by', Auth::id());
            }
            return $query;
        })->latest()->paginate(10);
        return Inertia::render('CarBrandModels/List', [
            'models' => $models
        ]);
    }

    public function get(Request $request)
    {
        $brandModels = CarBrandModel::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $brandModels;
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'brand' => 'required|exists:brands,id'
        ]);

        CarBrandModel::create([
            'name' => $request->name,
            'brand_id' => $request->brand
        ]);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'brand' => 'required|exists:brands,id'
        ]);

        $brandModel = CarBrandModel::findOrFail($id);
        $brandModel->name = $request->name;
        $brandModel->brand_id = $request->brand;
        $brandModel->save();

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $brandModel = CarBrandModel::findOrFail($id);
        $brandModel->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }
}
