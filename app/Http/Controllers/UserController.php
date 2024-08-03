<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct(protected FilterService $filterService)
    {
    }

    public function list(Request $request): Response
    {
        $loggedUserId = Auth::id();
        $users = User::where('id', '!=', $loggedUserId)->with('roles')->latest()->paginate(10);

        return Inertia::render('Users/List', [
            'users' => $users
        ]);
    }

    public function get(Request $request)
    {
        $users = User::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filterService->apply($query, $request->where);
            }
            return $query;
        })->get();

        return $users;
    }

    public function createView(Request $request)
    {
        $roles = Role::all();
        return Inertia::render('Users/Create', [
            'roles' => $roles,
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'role' => 'required|array|min:1',
            'role.*' => 'required|numeric|exists:roles,id'
        ], [
            'password.min' => 'O campo deve ter no mínimo :min caracteres'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $user->assignRole($request->role);

        event(new Registered($user));

        return to_route('users');
    }

    public function delete(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return to_route('users');
    }

    public function getUser(Request $request, $id): Response
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();

        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function edit(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8',
            'role' => 'required|array|min:1',
            'role.*' => 'required|numeric|exists:roles,id'
        ], [
            'password.min' => 'O campo deve ter no mínimo :min caracteres'
        ]);

        $user = User::findOrFail($id);

        if ($request->has('password')) {
            $user->password = $request->password;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        $user->syncRoles($request->role);

        return to_route('users');
    }
}
