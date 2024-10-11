<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandDataRequest;
use App\Models\Brands;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class BrandController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $brands = Brands::latest()->where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            if ($request->has('showAll') && $request->showAll === "false") {
                $query->where('created_by', Auth::id());
            }
            return $query;
        })->paginate(10);

        return Inertia::render('Admin/Brands/List', [
            'brands' => $brands
        ]);
    }

    public function create(BrandDataRequest $request): RedirectResponse
    {
        $this->patchBrand($request);

        return redirect()->back()->with('success', 'Item criado com sucesso.');
    }

    public function update(BrandDataRequest $request, $id): RedirectResponse
    {
        $brand = Brands::findOrFail($id);
        $this->patchBrand($request, $brand);

        return redirect()->back()->with('success', 'Item atualizado com sucesso.');
    }

    public function delete(Request $request, $id)
    {
        $brand = Brands::findOrFail($id);
        $brand->delete();

        return redirect()->back()->with('success', 'Item excluído com sucesso.');
    }

    public function apiGet(Request $request)
    {
        $brands = Brands::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();
        return $brands;
    }

    public function apiCreate(BrandDataRequest $request)
    {
        $brand = $this->patchBrand($request);

        return response()->json($brand);
    }

    public function patchBrand(Request $request, Brands $brand = null)
    {
        if (!$brand) {
            $brand = new Brands();
        }

        $brand->name = $request->name;

        $brand->save();
        return $brand;
    }
}
