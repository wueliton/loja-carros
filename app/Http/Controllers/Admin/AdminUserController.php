<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use App\Models\Store;
use App\Models\User;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request)
    {
        $lastStoreId = $request->user()->lastStoreId();
        $store = Store::findOrFail($lastStoreId);
        $users = $store->users()->with('roles')->where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->paginate(10);

        return Inertia::render("Admin/Users/List", [
            'users' => $users
        ]);
    }

    public function edit(Request $request, $id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();

        return Inertia::render("Admin/Users/Edit", [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function new()
    {
        $roles = Role::all();
        return Inertia::render("Admin/Users/Create", [
            'roles' => $roles
        ]);
    }

    public function update(UserPostRequest $request, $id)
    {
        $request->validated();
        $user = User::findOrFail($id);
        $this->patchUser($request, $user);
        return Redirect::route("admin.users.list");
    }

    public function create(UserPostRequest $request)
    {
        $request->validated();
        $this->patchUser($request);
        return Redirect::route("admin.users.list");
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return Redirect::back()->with('success', 'Item excluído com sucesso');
    }

    protected function patchUser(Request $request, User $user = null)
    {
        if (!$user) {
            $user = new User();
            $user->password = $request->password;
        } else {
            if ($request->has('password')) {
                $user->password = $request->password;
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        $user->assignRole($request->role);
    }
}