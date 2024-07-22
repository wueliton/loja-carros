<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MotorcycleController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService)
    {
    }

    public function list(): Response
    {
        $motorcycles = Motorcycle::with('brand:id,name', 'model:id,name')->select('title', 'brand', 'model', 'brand_id', 'model_id', 'created_at')->orderBy('created_at', 'desc')->get();

        return Inertia::render('Motorcycle/List', [
            'motorcycles' => $motorcycles
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'brand' => 'required|numeric|exists:brands,id',
            'model' => 'required|numeric|exists:motorcycle_brand_models,id',
            'type' => 'required|numeric|exists:motorcycle_types,id',
            'manufacturingYear' => 'required|numeric|digits:4',
            'year' => 'required|numeric|digits:4',
            'cylinder' => 'required|string',
            'motor' => 'string|nullable',
            'color' => 'required|numeric|exists:colors,id',
            'km' => 'required|numeric',
            'fuelCapacity' => 'required|numeric',
            'size' => 'string|nullable',
            'axisLength' => 'string|nullable',
            'optionals' => 'nullable|array',
            'optionals.*' => 'nullable|numeric|exists:motorcycle_optionals,id',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image',
            'details' => 'nullable|string'
        ]);

        $filesPath = [];

        if ($request->has('images')) {
            $files = $request->images;
            foreach ($files as $file) {
                $filePath = $this->imageUploadService->upload($file);
                array_push($filesPath, ['url' => $filePath]);
            }
        }

        $motorcycle = Motorcycle::create([
            'title' => $request->title,
            'brand_id' => $request->brand,
            'model_id' => $request->model,
            'type_id' => $request->type,
            'manufacturing_year' => $request->manufacturingYear,
            'year' => $request->year,
            'cilynder' => $request->cylinder,
            'motor' => $request->motor,
            'color_id' => $request->color,
            'km' => $request->km,
            'fuel_capacity' => $request->fuelCapacity,
            'size' => $request->size,
            'axis_length' => $request->axisLength,
            'details' => $request->details,
        ]);

        $motorcycle->images()->createMany($filesPath);

        if ($request->has('optionals')) {
            $motorcycle->optionals()->attach($request->optionals);
        }

        return Redirect::route('motorcycle');
    }
}
