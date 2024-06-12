<?php

namespace App\Http\Controllers;

use App\Models\VehicleTransmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;

class TransmissionController extends Controller
{
    public function list(Request $request): Response
    {
        $transmissions = VehicleTransmission::all();

        return Inertia::render('Transmissions/List', [
            'transmissions' => $transmissions
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        VehicleTransmission::create([
            'name' => $request->name
        ]);

        return Redirect::route('transmissions');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $transmission = VehicleTransmission::findOrFail($id);
        $transmission->name = $request->name;
        $transmission->save();

        return Redirect::route('transmissions');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $transmission = VehicleTransmission::findOrFail($id);
        $transmission->delete();

        return Redirect::route('transmissions');
    }
}
