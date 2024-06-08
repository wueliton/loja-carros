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
        print_r($request->color);

        VehicleColor::create([
            'color' => $request->color
        ]);

        return Redirect::route('colors');
    }
}
