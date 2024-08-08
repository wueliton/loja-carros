<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Services\FilterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ColorController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $colors = Color::latest()->where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            if ($request->has('showAll') && $request->showAll === "false") {
                $query->where('created_by', Auth::id());
            }
            return $query;
        })->paginate(10);

        return Inertia::render('Colors/List', [
            'colors' => $colors,
            'showAll' => $request->showAll
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
            'color' => 'required|string'
        ]);

        Color::create([
            'color' => $request->color
        ]);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'color' => 'required|string'
        ]);

        $color = Color::findOrFail($id);
        $color->color = $request->color;
        $color->save();

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $color = Color::findOrFail($id);
        $color->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }
}
