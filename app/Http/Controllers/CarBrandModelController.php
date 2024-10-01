<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarBrandModelDataRequest;
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

    public function create(CarBrandModelDataRequest $request): RedirectResponse
    {
        $this->patchModel($request);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(CarBrandModelDataRequest $request, $id): RedirectResponse
    {
        $brandModel = CarBrandModel::findOrFail($id);
        $this->patchModel($request, $brandModel);

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $brandModel = CarBrandModel::findOrFail($id);
        $brandModel->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function apiGet(Request $request)
    {
        $brandModels = CarBrandModel::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $brandModels;
    }

    public function apiCreate(CarBrandModelDataRequest $request)
    {
        $model = $this->patchModel($request);

        return response()->json($model);
    }

    private function patchModel(Request $request, CarBrandModel $model = null)
    {
        if (!$model) {
            $model = new CarBrandModel();
        }

        $model->name = $request->name;
        $model->brand_id = $request->brand;

        $model->save();
        return $model;
    }
}
