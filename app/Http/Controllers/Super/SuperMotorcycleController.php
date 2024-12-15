<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperEditMotorcycleDataRequest;
use App\Http\Requests\SuperMotorcycleDataRequest;
use App\Models\Motorcycle;
use App\Models\MotorcycleImages;
use App\Services\FilterService;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SuperMotorcycleController extends Controller
{
    public function __construct(protected FilterService $filterService, protected ImageUploadService $imageUploadService)
    {
    }

    public function listView(Request $request)
    {
        $motorcycles = Motorcycle::with(
            'brand:id,name',
            'model:id,name',
            'store:id,name',
            'images'
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

        return Inertia::render('Super/Motorcycles/List/index', [
            'motorcycles' => $motorcycles
        ]);
    }

    public function createView()
    {
        return Inertia::render('Super/Motorcycles/Create/index');
    }

    public function editView(Request $request, $id)
    {
        $motorcycle = Motorcycle::with('images', 'optionals')->findOrFail($id);

        return Inertia::render('Super/Motorcycles/Edit/index', [
            'motorcycle' => $motorcycle
        ]);
    }

    public function create(SuperMotorcycleDataRequest $request)
    {
        $this->patchMoto($request);

        return Redirect::route('super.motorcycles.list.view');
    }

    public function edit(SuperEditMotorcycleDataRequest $request, $id)
    {
        $motorcycle = Motorcycle::findOrFail($id);
        $this->patchMoto($request, $motorcycle);

        return Redirect::route('super.motorcycles.list.view');
    }

    public function delete(Request $request, $id)
    {
        $motorcycle = Motorcycle::findOrFail($id);
        $motorcycle->delete();

        return redirect()->back();
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

    private function patchMoto(Request $request, Motorcycle $motorcycle = null)
    {
        if (!$motorcycle) {
            $motorcycle = new Motorcycle();
        }

        $motorcycle->title = $request->title;
        $motorcycle->brand_id = $request->brand;
        $motorcycle->model_id = $request->model;
        $motorcycle->store_id = $request->storeId;
        $motorcycle->price = $request->price;
        $motorcycle->type_id = $request->type;
        $motorcycle->manufacturing_year = $request->manufacturingYear;
        $motorcycle->year = $request->year;
        $motorcycle->cylinder = $request->cylinder;
        $motorcycle->motor = $request->motor;
        $motorcycle->color_id = $request->color;
        $motorcycle->km = $request->km;
        $motorcycle->details = $request->details;
        $motorcycle->slug = Motorcycle::generateUniqueSlug($request->title);

        $motorcycle->save();

        if ($request->images && count($request->images) > 0) {
            $itemsToUpdate = array_filter($request->images, fn($item) => isset ($item['id']));
            $itemsToCreate = array_filter($request->images, fn($item) => !isset ($item['id']));

            if (count($itemsToUpdate) > 0) {
                foreach ($itemsToUpdate as $image) {
                    $motorcycleImage = MotorcycleImages::find($image['id']);

                    if ($motorcycleImage) {
                        $motorcycleImage->update($image);
                    }
                }
            }

            $motorcycle->images()->createMany($itemsToCreate);
        }

        if ($request->has('optionals')) {
            $motorcycle->optionals()->detach();
            $motorcycle->optionals()->attach($request->optionals);
        }

        return $motorcycle;
    }
}
