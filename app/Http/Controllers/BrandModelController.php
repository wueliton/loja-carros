<?php

namespace App\Http\Controllers;

use App\Models\VehicleBrandModel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class BrandModelController extends Controller
{
    public function list(Request $request): Response
    {
        $models = VehicleBrandModel::with('brand')->get();
        return Inertia::render('BrandModels/List', [
            'models' => $models
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:vehicle_brand_models|string',
            'brand' => 'required|exists:vehicle_brands,id'
        ]);

        VehicleBrandModel::create([
            'name' => $request->name,
            'brand_id' => $request->brand
        ]);

        return Redirect::route('brandModels');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|exists:vehicle_brand_models|string',
            'brand' => 'required|exists:vehicle_brands,id'
        ]);

        $brandModel = VehicleBrandModel::findOrFail($id);
        $brandModel->name = $request->name;
        $brandModel->brand = $request->brand;
        $brandModel->save();

        return Redirect::route('brandModels');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $brandModel = VehicleBrandModel::findOrFail($id);
        $brandModel->delete();

        return Redirect::route('brandModels');
    }
}
