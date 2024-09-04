<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Services\FilterService;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuperStoreController extends Controller
{
    public function __construct(protected FilterService $filterService, protected ImageUploadService $imageUploadService) {}

    public function list(Request $request)
    {
        $stores = Store::all();
        return Inertia::render('Super/Stores/List', [
            'stores' => $stores
        ]);
    }
}
