<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    protected $filter;

    public function __construct(FilterService $filterService)
    {
        $this->filter = $filterService;
    }

    public function list(Request $request): Response
    {
        $loggedUserId = Auth::id();
        $users = User::where('id', '!=', $loggedUserId)->get();

        return Inertia::render('Users/List', [
            'users' => $users
        ]);
    }

    public function get(Request $request)
    {
        $users = User::where(function ($query) use ($request) {
            if ($request->has('where')) {
                $query = $this->filter->apply($query, $request->where);
            }
            return $query;
        })->get();

        return $users;
    }
}
