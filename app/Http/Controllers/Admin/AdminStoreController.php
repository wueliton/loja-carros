<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Store;
use App\Services\FilterService;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AdminStoreController extends Controller
{
    public function __construct(protected FilterService $filterService, protected ImageUploadService $imageUploadService)
    {
    }

    public function edit(Request $request)
    {
        $lastStoreId = $request->user()->lastStoreId();
        $store = Store::with('users:id')->findOrFail($lastStoreId);
        $store->users_ids = $store->users->pluck('id')->toArray();
        return Inertia::render('Admin/Store/Edit', [
            'store' => $store
        ]);
    }

    public function update(StorePostRequest $request)
    {
        $request->validated();
        $lastStoreId = $request->user()->lastStoreId();

        $store = Store::findOrFail($lastStoreId);
        $this->patchStore($request, $store);
        return Redirect::route('stores');
    }

    protected function patchStore(Request $request, Store $store = null)
    {
        if (!$store) {
            $store = new Store();
        }

        $filePath = 'no-image.jpg';

        if ($request->has('logo_url')) {
            $file = $request->file('logo_url');
            $filePath = $this->imageUploadService->upload($file);
        }

        $store->name = $request->name;
        $store->logo_url = $filePath;
        $store->store_number = $request->store_number;
        $store->email = $request->email;
        $store->phone = $request->phone;
        $store->whatsapp = $request->whatsapp;

        $store->save();

        $store->users()->detach();
        $store->users()->attach($request->users);
    }
}
