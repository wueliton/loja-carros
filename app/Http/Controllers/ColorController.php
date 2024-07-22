<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\VehicleColor;
use App\Services\FilterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ColorController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $colors = Color::all();
        return Inertia::render('Colors/List', [
            'colors' => $colors
        ]);
    }

    public function get(Request $request)
    {
        $colors = Color::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $colors;
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'color' => 'required|string|unique:colors'
        ]);

        Color::create([
            'color' => $request->color
        ]);

        return Redirect::route('colors');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'color' => 'required|string|unique:colors'
        ]);

        $color = Color::findOrFail($id);
        $color->color = $request->color;
        $color->save();

        return Redirect::route('colors');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $color = Color::findOrFail($id);
        $color->delete();

        return Redirect::route('colors');
    }
}
