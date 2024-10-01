<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $activities = Activity::where('causer_id', Auth::id())->latest()->take(20)->get();

        return Inertia::render('User/Dashboard/index', [
            'logs' => $activities
        ]);
    }
}
