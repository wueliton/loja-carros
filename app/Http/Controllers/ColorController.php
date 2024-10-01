<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorDataRequest;
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

    public function create(ColorDataRequest $request): RedirectResponse
    {
        $this->patchColor($request);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(ColorDataRequest $request, $id): RedirectResponse
    {
        $color = Color::findOrFail($id);
        $this->patchColor($request, $color);

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $color = Color::findOrFail($id);
        $color->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function apiGet(Request $request)
    {
        $colors = Color::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $colors;
    }

    public function apiCreate(ColorDataRequest $request)
    {
        $color = $this->patchColor($request);

        return response()->json($color);
    }

    private function patchColor(Request $request, Color $color = null)
    {
        if (!$color) {
            $color = new Color();
        }

        $color->color = $request->color;
        $color->save();

        return $color;
    }
}
