<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class StoreController extends Controller
{
    public function index(Request $request): Response
    {
        $stores = Store::all();

        return Inertia::render('Stores/Index', [
            'stores' => $stores,
        ]);
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $store = Store::findOrFail($id);
        $store->delete();
        return Redirect::route('stores');
    }
}
