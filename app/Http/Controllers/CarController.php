<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImages;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class CarController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService)
    {
    }

    public function list(Request $request): Response
    {
        $cars = Car::with('brand:id,name', 'model:id,name')->select('id', 'title', 'brand_id', 'model_id', 'created_at')->orderBy('created_at', 'desc')->get();

        return Inertia::render('Cars/List', [
            'cars' => $cars
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'brand' => 'required|numeric|exists:brands,id',
            'model' => 'required|numeric|exists:car_brand_models,id',
            'manufacturingYear' => 'required|numeric|digits:4',
            'year' => 'required|numeric|digits:4',
            'version' => 'string|nullable',
            'color' => 'required|numeric|exists:colors,id',
            'fuelType' => 'required|numeric|exists:fuel_types,id',
            'doors' => 'required|numeric',
            'transmission' => 'required|numeric|exists:car_transmissions,id',
            'motor' => 'required|numeric',
            'km' => 'required|numeric',
            'lastDigit' => 'required|numeric',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image',
            'details' => 'nullable|string',
            'seats' => 'nullable|numeric',
            'power' => 'nullable|string',
            'size' => 'nullable|string',
            'fuelCapacity' => 'required|numeric',
            'axisLength' => 'nullable|string',
            'optionals' => 'nullable|array',
            'optionals.*' => 'nullable|numeric|exists:car_optionals,id',
        ]);

        $filesPath = [];

        if ($request->has('images')) {
            $files = $request->images;
            foreach ($files as $file) {
                $filePath = $this->imageUploadService->upload($file);
                array_push($filesPath, ['url' => $filePath]);
            }
        }

        $car = Car::create([
            'title' => $request->title,
            'brand_id' => $request->brand,
            'model_id' => $request->model,
            'manufacturing_year' => $request->manufacturingYear,
            'year' => $request->year,
            'version' => $request->version,
            'color_id' => $request->color,
            'fuel_type_id' => $request->fuelType,
            'doors' => $request->doors,
            'transmission_id' => $request->transmission,
            'motor' => $request->motor,
            'km' => $request->km,
            'last_digit' => $request->lastDigit,
            'details' => $request->details,
            'seats' => $request->seats,
            'power' => $request->power,
            'size' => $request->size,
            'fuel_capacity' => $request->fuelCapacity,
            'axis_length' => $request->axisLength
        ]);

        $car->images()->createMany($filesPath);

        if ($request->has('optionals')) {
            $car->optionals()->attach($request->optionals);
        }

        return Redirect::route('cars');
    }

    public function edit(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'brand' => 'required|numeric|exists:brands,id',
            'model' => 'required|numeric|exists:car_brand_models,id',
            'manufacturingYear' => 'required|numeric|digits:4',
            'year' => 'required|numeric|digits:4',
            'version' => 'string|nullable',
            'color' => 'required|numeric|exists:colors,id',
            'fuelType' => 'required|numeric|exists:fuel_types,id',
            'doors' => 'required|numeric',
            'transmission' => 'required|numeric|exists:car_transmissions,id',
            'motor' => 'required|numeric',
            'km' => 'required|numeric',
            'lastDigit' => 'required|numeric',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image',
            'details' => 'nullable|string',
            'seats' => 'nullable|numeric',
            'power' => 'nullable|string',
            'size' => 'nullable|string',
            'fuelCapacity' => 'required|numeric',
            'axisLength' => 'nullable|string',
            'optionals' => 'nullable|array',
            'optionals.*' => 'nullable|numeric|exists:car_optionals,id',
        ]);

        $car = Car::findOrFail($id);

        $filesPath = [];

        if ($request->has('images')) {
            $files = $request->images;
            foreach ($files as $file) {
                $filePath = $this->imageUploadService->upload($file);
                array_push($filesPath, ['url' => $filePath]);
            }
        }

        $car->title = $request->title;
        $car->brand_id = $request->brand;
        $car->model_id = $request->model;
        $car->manufacturing_year = $request->manufacturingYear;
        $car->year = $request->year;
        $car->version = $request->version;
        $car->color_id = $request->color;
        $car->fuel_type_id = $request->fuelType;
        $car->doors = $request->doors;
        $car->transmission_id = $request->transmission;
        $car->motor = $request->motor;
        $car->km = $request->km;
        $car->last_digit = $request->lastDigit;
        $car->details = $request->details;
        $car->seats = $request->seats;
        $car->power = $request->power;
        $car->size = $request->size;
        $car->fuel_capacity = $request->fuelCapacity;
        $car->axis_length = $request->axisLength;

        $car->save();

        $car->images()->createMany($filesPath);

        if ($request->has('optionals')) {
            $car->optionals()->detach();
            $car->optionals()->attach($request->optionals);
        }

        return Redirect::route('cars');
    }

    public function getCar(Request $request, $id): Response
    {
        $car = Car::with('images', 'optionals')->findOrFail($id);

        return Inertia::render('Cars/Edit', [
            'car' => $car
        ]);
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return Redirect::route('cars');
    }

    public function deleteImage(Request $request, $id)
    {
        $image = CarImages::findOrFail($id);
        $filePath = 'uploads/' . $image->url;
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $image->delete();

        return response()->json(['success' => true], 200);
    }
}