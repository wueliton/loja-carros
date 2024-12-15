<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperCarDataRequest;
use App\Http\Requests\SuperCarEditDataRequest;
use App\Services\FilterService;
use App\Models\Car;
use App\Models\CarImages;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SuperCarController extends Controller
{
    public function __construct(protected FilterService $filterService, protected ImageUploadService $imageUploadService)
    {
    }

    public function listView(Request $request)
    {
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
            )->where(function ($query) use ($request) {
                if ($request->has('where')) {
                    $query = $this->filterService->apply($query, $request->where);
                }
                return $query;
            })->latest()->paginate(10);

        return Inertia::render('Super/Cars/List/index', [
            'cars' => $cars
        ]);
    }

    public function createView()
    {
        return Inertia::render('Super/Cars/Create/index');
    }

    public function editView(Request $request, $id)
    {
        $car = Car::with('images', 'optionals')->findOrFail($id);

        return Inertia::render('Super/Cars/Edit/index', [
            'car' => $car
        ]);
    }

    public function create(SuperCarDataRequest $request)
    {
        $this->patchCar($request);

        return Redirect::route('super.cars.list.view');
    }

    public function edit(SuperCarEditDataRequest $request, $id)
    {
        $car = Car::findOrFail($id);
        $this->patchCar($request, $car);

        return Redirect::route('super.cars.list.view');
    }

    public function delete(Request $request, $id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->back();
    }

    private function patchCar(Request $request, Car $car = null)
    {
        if (!$car) {
            $car = new Car();
            $car->slug = Car::generateUniqueSlug($request->title);
        }

        $car->title = $request->title;
        $car->brand_id = $request->brand;
        $car->model_id = $request->model;
        $car->price = $request->price;
        $car->store_id = $request->storeId;
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
