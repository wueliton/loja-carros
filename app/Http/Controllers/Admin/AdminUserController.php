<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\QueryBuilder\QueryBuilder;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    public function __construct(protected FilterService $filterService) {}

    public function list(Request $request)
    {
        $lastStoreId = $request->user()->lastStoreId();
        $users = QueryBuilder::for(Store::class)->filters($request)->findOrFail($lastStoreId)->users();
        return Inertia::render('Admin/Users/List', [
            'users' => $users
        ]);
    }
}
