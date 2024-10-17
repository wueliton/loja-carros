<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDataRequest;
use App\Models\User;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class SuperUserController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function listView(Request $request)
    {
        $users = User::with('roles')->latest()->where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
                return $query;
            }
        })->paginate(10);
        $roles = Role::all();

        return Inertia::render('Super/Users/List', [
            'users' => $users
        ]);
    }

    public function createView(Request $request)
    {
        $roles = Role::all();

        return Inertia::render('Super/Users/Create', [
            'roles' => $roles
        ]);
    }

    public function editView(Request $request, $id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();

        return Inertia::render('Super/Users/Edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function create(UserDataRequest $request)
    {
        $this->patchUser($request);
        return Redirect::route('super.users.list.view');
    }

    public function edit(UserDataRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $this->patchUser($request, $user);

        return Redirect::route('super.users.list.view');
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back();
    }

    private function patchUser(Request $request, User $user = null)
    {
        if (!$user) {
            $user = new User();
        }

        if ($user && $request->has('password') && isset($request->password)) {
            $user->password = $request->password;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        $user->syncRoles($request->role);

        return $user;
    }
}
