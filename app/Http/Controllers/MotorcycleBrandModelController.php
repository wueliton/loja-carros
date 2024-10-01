<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotorcycleBrandModelDataRequest;
use App\Models\MotorcycleBrandModel;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class MotorcycleBrandModelController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $models = MotorcycleBrandModel::with('brand')->where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            if ($request->has('showAll') && $request->showAll === "false") {
                $query->where('created_by', Auth::id());
            }
            return $query;
        })->latest()->paginate(10);
        return Inertia::render('MotorcycleBrandModels/List', [
            'models' => $models
        ]);
    }

    public function create(MotorcycleBrandModelDataRequest $request): RedirectResponse
    {
        $this->patchModel($request);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(MotorcycleBrandModelDataRequest $request, $id): RedirectResponse
    {
        $model = MotorcycleBrandModel::findOrFail($id);
        $this->patchModel($request, $model);

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $brandModel = MotorcycleBrandModel::findOrFail($id);
        $brandModel->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function apiGet(Request $request)
    {
        $brandModels = MotorcycleBrandModel::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $brandModels;
    }

    public function apiCreate(MotorcycleBrandModelDataRequest $request)
    {
        $model = $this->patchModel($request);
        return response()->json($model);
    }

    private function patchModel(Request $request, MotorcycleBrandModel $model = null)
    {
        if (!$model) {
            $model = new MotorcycleBrandModel();
        }

        $model->name = $request->name;
        $model->brand_id = $request->brand;
        $model->save();

        return $model;
    }
}
