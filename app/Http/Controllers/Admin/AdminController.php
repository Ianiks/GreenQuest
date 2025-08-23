<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserActivity;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'total_points' => User::sum('points'),
            'total_carbon_saved' => User::sum('carbon_saved'),
            'recent_activities' => UserActivity::latest()->take(10)->get()
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
