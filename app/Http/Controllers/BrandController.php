<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class BrandController extends Controller
{
    protected $filter;

    public function __construct(FilterService $filterService)
    {
        $this->filter = $filterService;
    }

    public function list(Request $request): Response
    {
        $brands = Brands::latest()->where(function ($query) use ($request) {
            if (!$request->user()->hasRole('admin')) {
                $query->where('created_by', Auth::id());
            }
        })->paginate(10);

        return Inertia::render('Brands/List', [
            'brands' => $brands
        ]);
    }

    public function get(Request $request)
    {
        $brands = Brands::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filter->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $brands;
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Brands::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $fuelType = Brands::findOrFail($id);
        $fuelType->name = $request->name;
        $fuelType->save();

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id)
    {
        $fuelType = Brands::findOrFail($id);
        $fuelType->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }
}
