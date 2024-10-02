<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChangeSuggestDataRequest;
use App\Models\Store;
use App\Models\StoreChangeSuggest;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserStoreController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService)
    {
    }

    function getView(Request $request)
    {
        $lastStoreId = $request->user()->lastStoreId();
        $userId = Auth::id();
        $store = Store::find($lastStoreId);
        $changeRequest = StoreChangeSuggest::where("created_by", $userId)->where('status', 'pending')->latest()->first();

        return Inertia::render('User/Store/index', [
            'store' => $store,
            'changeRequest' => $changeRequest
        ]);
    }

    function suggestChanges(StoreChangeSuggestDataRequest $request)
    {
        $lastStoreId = $request->user()->lastStoreId();

        StoreChangeSuggest::where('created_by', Auth::id())->where('status', 'pending')->where('store_id', $lastStoreId)->update(['status' => 'reproved']);

        $filePath = 'no-image.jpg';

        if ($request->has('logo_url')) {
            $file = $request->file('logo_url');
            $filePath = $this->imageUploadService->upload($file);
        }

        $storeSuggest = new StoreChangeSuggest();
        $storeSuggest->name = $request->name;
        $storeSuggest->store_number = $request->store_number;
        $storeSuggest->email = $request->email;
        $storeSuggest->phone = $request->phone;
        $storeSuggest->whatsapp = $request->whatsapp;
        $storeSuggest->logo_url = $filePath;
        $storeSuggest->store_id = $lastStoreId;

        $storeSuggest->save();

        return Redirect::refresh();
    }
}
