<?php

namespace App\Http\Controllers;

use App\Models\MotorcycleBrandModel;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MotorcycleBrandModelController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $models = MotorcycleBrandModel::with('brand')->get();
        return Inertia::render('MotorcycleBrandModels/List', [
            'models' => $models
        ]);
    }

    public function get(Request $request)
    {
        $brandModels = MotorcycleBrandModel::where(function ($query) use ($request) {
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
            'name' => 'required|unique:motorcycle_brand_models|string',
            'brand' => 'required|exists:brands,id'
        ]);

        MotorcycleBrandModel::create([
            'name' => $request->name,
            'brand_id' => $request->brand
        ]);

        return Redirect::route('motorcycleBrandModel');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:motorcycle_brand_models|string',
            'brand' => 'required|exists:brands,id'
        ]);

        $brandModel = MotorcycleBrandModel::findOrFail($id);
        $brandModel->name = $request->name;
        $brandModel->brand_id = $request->brand;
        $brandModel->save();

        return Redirect::route('motorcycleBrandModel');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $brandModel = MotorcycleBrandModel::findOrFail($id);
        $brandModel->delete();

        return Redirect::route('motorcycleBrandModel');
    }
}
