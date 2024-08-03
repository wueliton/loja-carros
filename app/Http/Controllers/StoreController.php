<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Services\ImageUploadService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class StoreController extends Controller
{

    public function __construct(protected ImageUploadService $imageUploadService)
    {
    }

    public function index(Request $request): Response
    {
        $stores = Store::latest()->paginate(10);

        return Inertia::render('Stores/List', [
            'stores' => $stores,
        ]);
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $store = Store::findOrFail($id);
        $store->users()->detach();
        $store->delete();
        return Redirect::route('stores');
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'store_number' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:10,11',
            'whatsapp' => 'required|numeric|digits_between:10,11',
            'users' => 'required|array',
            'users.*' => 'nullable|required|numeric|exists:users,id',
            'logo_url' => 'nullable|file|mimes:png,jpg,jpeg,gif,webp|max:1024'
        ], [
            'phone.digits_between' => 'O campo deve ter entre :min e :max números',
            'whatsapp.digits_between' => 'O campo deve ter entre :min e :max números'
        ]);

        $filePath = 'no-image.jpg';

        if ($request->has('logo_url')) {
            $file = $request->file('logo_url');
            $filePath = $this->imageUploadService->upload($file);
        }

        $store = Store::create([
            'name' => $request->name,
            'logo_url' => $filePath,
            'store_number' => $request->store_number,
            'email' => $request->email,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
        ]);

        $store->users()->attach($request->users);

        event(new Registered($store));

        return Redirect::route('stores');
    }

    public function getStore(Request $request, $id): Response | RedirectResponse
    {
        try {
            $store = Store::with('users:id')->findOrFail($id);

            $store->users_ids = $store->users->pluck('id')->toArray();

            return Inertia::render('Stores/Edit', [
                'store' => $store
            ]);
        } catch (ModelNotFoundException $e) {
            return Redirect::route('stores');
        }
    }

    public function edit(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'store_number' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:10,11',
            'whatsapp' => 'required|numeric|digits_between:10,11',
            'users' => 'required|array',
            'users.*' => 'nullable|required|numeric|exists:users,id',
            'logo_url' => 'nullable|file|mimes:png,jpg,jpeg,gif,webp|max:1024'
        ], [
            'phone.digits_between' => 'O campo deve ter entre :min e :max números',
            'whatsapp.digits_between' => 'O campo deve ter entre :min e :max números'
        ]);

        $store = Store::findOrFail($id);

        if ($request->has('logo_url')) {
            $filePath = 'uploads/' . $store->logo_url;
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $file = $request->file('logo_url');
            $fileName = $this->imageUploadService->upload($file);
            $store->logo_url = $fileName;
        }

        $store->name = $request->name;
        $store->store_number = $request->store_number;
        $store->email = $request->email;
        $store->phone = $request->phone;
        $store->whatsapp = $request->whatsapp;

        $store->save();

        $store->users()->detach();
        $store->users()->attach($request->users);

        return Redirect::route('stores');
    }
}
