<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataRequest;
use App\Models\Store;
use App\Services\FilterService;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SuperStoreController extends Controller
{
    public function __construct(protected FilterService $filterService, protected ImageUploadService $imageUploadService)
    {
    }

    public function listView(Request $request)
    {
        $stores = Store::latest()->where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
                return $query;
            }
        })->paginate(10);

        return Inertia::render('Super/Stores/List', [
            'stores' => $stores
        ]);
    }

    public function create(StoreDataRequest $request)
    {
        $this->patchStore($request);

        return Redirect::route('super.stores.list.view');
    }

    public function edit(StoreDataRequest $request, $id)
    {
        $store = Store::findOrFail($id);
        $this->patchStore($request, $store);

        return Redirect::route('super.stores.list.view');
    }

    public function delete(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return redirect()->back();
    }

    public function editView(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $store->users_ids = $store->users()->pluck('users.id');

        return Inertia::render('Super/Stores/Edit', [
            'store' => $store
        ]);
    }

    public function apiGet(Request $request)
    {
        $stores = Store::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();

        return $stores;
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

    private function patchStore(Request $request, Store $store = null)
    {
        $fileName = 'no-image.jpg';

        if (!$store) {
            $store = new Store();
            $store->logo_url = $fileName;
        }

        if ($request->has('logo_url') && isset($request->logo_url)) {
            if ($store->logo_url) {
                $filePath = 'uploads/' . $store->logo_url;

                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }

            $store->logo_url = $request->logo_url;
        }

        $store->name = $request->name;
        $store->store_number = $request->store_number;
        $store->email = $request->email;
        $store->phone = $request->phone;
        $store->whatsapp = $request->whatsapp;
        $store->instagram = $request->instagram;
        $store->facebook = $request->facebook;
        $store->site = $request->site;
        $store->max_cars = $request->max_cars;
        $store->max_motorcycles = $request->max_motorcycles;
        $store->save();

        $store->users()->detach();
        $store->users()->attach($request->users);

        return $store;
    }
}
