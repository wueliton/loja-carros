<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotorcycleDataRequest;
use App\Models\Motorcycle;
use App\Models\MotorcycleImages;
use App\Services\FilterService;
use App\Services\ImageUploadService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class MotorcycleController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService, protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $motorcycles = Motorcycle::with('brand:id,name', 'model:id,name', 'store:id,name', 'images')->select('id', 'title', 'brand_id', 'model_id', 'store_id', 'created_at')->where(function ($query) use ($request) {
            if (!$request->user()->hasRole('super')) {
                $userStore = $request->user()->lastStore()->pluck('store_id');
                $query->where('store_id', $userStore);
            }
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->latest()->paginate(10);

        return Inertia::render('User/Motorcycle/List/index', [
            'motorcycles' => $motorcycles
        ]);
    }

    public function editView(Request $request, $id)
    {
        try {
            $motorcycle = Motorcycle::with('images', 'optionals')->findOrFail($id);

            return Inertia::render('User/Motorcycle/Edit/index', [
                'motorcycle' => $motorcycle
            ]);
        } catch (ModelNotFoundException $e) {
            return Redirect::route('motorcycle.list.view');
        }
    }

    public function create(MotorcycleDataRequest $request): RedirectResponse
    {
        $this->patchMotorcycle($request);

        return Redirect::route('motorcycle.list.view');
    }

    public function edit(MotorcycleDataRequest $request, $id): RedirectResponse
    {
        $motorcycle = Motorcycle::findOrFail($id);
        $this->patchMotorcycle($request, $motorcycle);

        return Redirect::route('motorcycle.list.view');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $motorcycle = Motorcycle::findOrFail($id);
        $motorcycle->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function apiDeleteImage(Request $request, $id)
    {
        $image = MotorcycleImages::findOrFail($id);
        $filePath = 'uploads/' . $image->url;
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $image->delete();

        return response()->json(['success' => true], 200);
    }

    private function patchMotorcycle(Request $request, Motorcycle $motorcycle = null)
    {
        if (!$motorcycle) {
            $motorcycle = new Motorcycle();
        }

        $filesPath = [];

        if ($request->has('images')) {
            $files = $request->images;
            foreach ($files as $file) {
                $filePath = $this->imageUploadService->upload($file);
                array_push($filesPath, ['url' => $filePath]);
            }
        }

        $lastStoreId = $request->user()->lastStoreId();

        $motorcycle->title = $request->title;
        $motorcycle->brand_id = $request->brand;
        $motorcycle->model_id = $request->model;
        $motorcycle->store_id = $lastStoreId;
        $motorcycle->price = $request->price;
        $motorcycle->type_id = $request->type;
        $motorcycle->manufacturing_year = $request->manufacturingYear;
        $motorcycle->year = $request->year;
        $motorcycle->cylinder = $request->cylinder;
        $motorcycle->motor = $request->motor;
        $motorcycle->color_id = $request->color;
        $motorcycle->km = $request->km;
        $motorcycle->details = $request->details;

        $motorcycle->save();

        $motorcycle->images()->createMany($filesPath);

        if ($request->has('optionals')) {
            $motorcycle->optionals()->detach();
            $motorcycle->optionals()->attach($request->optionals);
        }

        return $motorcycle;
    }
}
