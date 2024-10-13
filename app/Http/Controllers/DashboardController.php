<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $activities = Activity::where('causer_id', Auth::id())->latest()->take(20)->get();

        $isSuperAdmin = $request->user()->hasRole('super');

        $route = $isSuperAdmin ? 'Super/Dashboard/index' : 'User/Dashboard/index';

        return Inertia::render($route, [
            'logs' => $activities
        ]);
    }
}
