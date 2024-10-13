<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Services\FilterService;
use App\Services\ImageUploadService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class StoreController extends Controller
{

    public function __construct(protected ImageUploadService $imageUploadService, protected FilterService $filterService)
    {
    }

    public function changeUserStore(Request $request, $storeId)
    {
        $user = $request->user();
        $user->lastStore()->updateOrCreate(
            ['user_id' => $user->id],
            ['store_id' => $storeId]
        );

        return redirect('dashboard');
    }

    public function get(Request $request)
    {
        $loggedUserId = Auth::id();
        $stores = Store::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->whereHas('users', function ($query) use ($loggedUserId) {
            $query->whereIn('user_id', [$loggedUserId]);
        })->get();

        return $stores;
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $store = Store::findOrFail($id);
        $store->users()->detach();
        $store->delete();
        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function getStore(Request $request, $id): Response|RedirectResponse
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

        if ($request->has('logo_url') && isset($request->logo_url)) {
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

        return redirect()->refresh();
    }
}
