<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use App\Models\MotorcycleImages;
use App\Models\Store;
use App\Services\ImageUploadService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class MotorcycleController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService)
    {
    }

    public function list(Request $request): Response
    {
        $motorcycles = Motorcycle::with('brand:id,name', 'model:id,name', 'images')->select('id', 'title', 'brand_id', 'model_id', 'created_at')->where(function ($query) use ($request) {
            if (!$request->user()->hasRole('admin')) {
                $userStores = Store::whereHas('users', function ($query) {
                    $query->whereIn('user_id', [Auth::id()]);
                })->pluck('id');
                $query->whereIn('store_id', $userStores);
            }
        })->latest()->paginate(10);

        return Inertia::render('Motorcycle/List', [
            'motorcycles' => $motorcycles
        ]);
    }

    public function getMotorcycle(Request $request, $id)
    {
        try {
            $motorcycle = Motorcycle::with('images', 'optionals')->findOrFail($id);

            return Inertia::render('Motorcycle/Edit', [
                'motorcycle' => $motorcycle
            ]);
        } catch (ModelNotFoundException $e) {
            return Redirect::route('motorcycle');
        }
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'brand' => 'required|numeric|exists:brands,id',
            'model' => 'required|numeric|exists:motorcycle_brand_models,id',
            'store' => 'required|numeric|exists:stores,id',
            'price' => 'required|numeric',
            'type' => 'required|numeric|exists:motorcycle_types,id',
            'manufacturingYear' => 'required|numeric|digits:4',
            'year' => 'required|numeric|digits:4',
            'cylinder' => 'required',
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
            'store_id' => $request->store,
            'price' => $request->price,
            'type_id' => $request->type,
            'manufacturing_year' => $request->manufacturingYear,
            'year' => $request->year,
            'cylinder' => $request->cylinder,
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

    public function edit(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'brand' => 'required|numeric|exists:brands,id',
            'model' => 'required|numeric|exists:motorcycle_brand_models,id',
            'store' => 'required|numeric|exists:stores,id',
            'price' => 'required|numeric',
            'type' => 'required|numeric|exists:motorcycle_types,id',
            'manufacturingYear' => 'required|numeric|digits:4',
            'year' => 'required|numeric|digits:4',
            'cylinder' => 'required',
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

        $motorcycle = Motorcycle::findOrFail($id);

        $filesPath = [];

        if ($request->has('images')) {
            $files = $request->images;
            foreach ($files as $file) {
                $filePath = $this->imageUploadService->upload($file);
                array_push($filesPath, ['url' => $filePath]);
            }
        }

        $motorcycle->title = $request->title;
        $motorcycle->brand_id = $request->brand;
        $motorcycle->model_id = $request->model;
        $motorcycle->price = $request->price;
        $motorcycle->store_id = $request->store;
        $motorcycle->type_id = $request->type;
        $motorcycle->manufacturing_year = $request->manufacturingYear;
        $motorcycle->year = $request->year;
        $motorcycle->cylinder = $request->cylinder;
        $motorcycle->motor = $request->motor;
        $motorcycle->color_id = $request->color;
        $motorcycle->km = $request->km;
        $motorcycle->fuel_capacity = $request->fuelCapacity;
        $motorcycle->size = $request->size;
        $motorcycle->axis_length = $request->axisLength;
        $motorcycle->details = $request->details;

        $motorcycle->save();

        $motorcycle->images()->createMany($filesPath);

        if ($request->has('optionals')) {
            $motorcycle->optionals()->detach();
            $motorcycle->optionals()->attach($request->optionals);
        }

        return Redirect::route('motorcycle');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $motorcycle = Motorcycle::findOrFail($id);
        $motorcycle->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function deleteImage(Request $request, $id)
    {
        $image = MotorcycleImages::findOrFail($id);
        $filePath = 'uploads/' . $image->url;
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $image->delete();

        return response()->json(['success' => true], 200);
    }
}
