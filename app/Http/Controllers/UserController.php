<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function view(Request $request): Response
    {
        $users = User::all();

        return Inertia::render('Users/View', [
            'users' => $users
        ]);
    }

    public function list(Request $request)
    {
        $users = User::where('name', $request->name)->get();

        return $users;
    }
}
