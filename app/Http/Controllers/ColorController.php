<?php

namespace App\Http\Controllers;

use App\Models\VehicleColor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ColorController extends Controller
{
    public function list(Request $request): Response
    {
        $colors = VehicleColor::all();
        return Inertia::render('Colors/List', [
            'colors' => $colors
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'color' => 'required|string'
        ]);

        VehicleColor::create([
            'color' => $request->color
        ]);

        return Redirect::route('colors');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'color' => 'required|string'
        ]);

        $color = VehicleColor::findOrFail($id);
        $color->color = $request->color;
        $color->save();

        return Redirect::route('colors');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $color = VehicleColor::findOrFail($id);
        $color->delete();

        return Redirect::route('colors');
    }
}
