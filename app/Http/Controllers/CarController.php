<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarDataRequest;
use App\Http\Requests\CarEditDataRequest;
use App\Models\Car;
use App\Models\CarImages;
use App\Models\Store;
use App\Services\FilterService;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class CarController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService, protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $lastStoreId = $request->user()->lastStoreId();
        $cars = Car::with(
            'brand:id,name',
            'model:id,name',
            'store:id,name'
        )->select(
                'id',
                'title',
                'brand_id',
                'model_id',
                'store_id',
                'created_at'
            )->where('store_id', $lastStoreId)->where(function ($query) use ($request) {
                if ($request->has('where')) {
                    $query = $this->filterService->apply($query, $request->where);
                }
                return $query;
            })->latest()->paginate(10);

        $canCreate = $this->canCreate($lastStoreId);

        return Inertia::render('User/Cars/List/index', [
            'cars' => $cars,
            'canCreate' => $canCreate
        ]);
    }

    public function create(CarDataRequest $request): RedirectResponse
    {
        $lastStoreId = $request->user()->lastStoreId();
        $canCreate = $this->canCreate($lastStoreId);

        if (!$canCreate)
            return Redirect::route('cars.list.view');

        $this->patchCar($request);

        return Redirect::route('cars.list.view');
    }

    public function edit(CarEditDataRequest $request, $id): RedirectResponse
    {
        $car = Car::findOrFail($id);
        $this->patchCar($request, $car);

        return Redirect::route('cars.list.view');
    }

    public function editView(Request $request, $id): Response
    {
        $car = Car::with('images', 'optionals')->findOrFail($id);

        return Inertia::render('User/Cars/Edit/index', [
            'car' => $car
        ]);
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function apiDeleteImage(Request $request, $id)
    {
        $image = CarImages::findOrFail($id);
        $filePath = 'uploads/' . $image->url;
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $image->delete();

        return response()->json(['success' => true], 200);
    }

    public function canCreate($lastStoreId): bool
    {
        $storeCarLimit = Store::where('id', $lastStoreId)->value('max_cars');
        $storeCarsCount = Car::where('store_id', $lastStoreId)->count();

        $canCreate = isset($storeCarLimit) ? $storeCarLimit > $storeCarsCount : true;
        return $canCreate;
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ]);

        $filePath = $this->imageUploadService->upload($request->image);

        return response()->json([
            'name' => $filePath,
        ]);
    }

    public function patchCar(Request $request, Car $car = null)
    {
        if (!$car) {
            $car = new Car();
        }

        $currentStore = $request->user()->lastStoreId();

        if (!$currentStore)
            return $car;

        $car->title = $request->title;
        $car->brand_id = $request->brand;
        $car->model_id = $request->model;
        $car->price = $request->price;
        $car->store_id = $currentStore;
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
        $car->slug = Car::generateUniqueSlug($request->title);

        $car->save();

        if ($request->images && count($request->images) > 0) {
            $itemsToUpdate = array_filter($request->images, fn($item) => isset ($item['id']));
            $itemsToCreate = array_filter($request->images, fn($item) => !isset ($item['id']));

            if (count($itemsToUpdate) > 0) {
                foreach ($itemsToUpdate as $image) {
                    $carImage = CarImages::find($image['id']);

                    if ($carImage) {
                        $carImage->update($image);
                    }
                }
            }

            $car->images()->createMany($itemsToCreate);
        }

        if ($request->has('optionals')) {
            $car->optionals()->detach();
            $car->optionals()->attach($request->optionals);
        }

        return $car;
    }
}
