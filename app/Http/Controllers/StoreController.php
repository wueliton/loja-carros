<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Auth\Events\Registered;
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

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'store_number' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:10,11',
            'whatsapp' => 'required|numeric|digits_between:10,11'
        ], [
            'phone.digits_between' => 'O campo deve ter entre :min e :max números',
            'whatsapp.digits_between' => 'O campo deve ter entre :min e :max números'
        ]);

        $store = Store::create([
            'name' => $request->name,
            'logo_url' => 'https://www.autoshoppingglobal.com.br/Imgs/lg/199.gif',
            'store_number' => $request->store_number,
            'email' => $request->email,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
        ]);

        event(new Registered($store));

        return Redirect::route('stores');
    }
}
