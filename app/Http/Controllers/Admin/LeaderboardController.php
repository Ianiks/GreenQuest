<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Get top 3 users by points with their team information
        $topUsers = User::with('team')
                       ->orderBy('points', 'desc')
                       ->take(3)
                       ->get();

        // Get paginated list of all users with their teams
        $users = User::with('team')
                    ->orderBy('points', 'desc')
                    ->paginate(20);

        return view('admin.leaderboard.index', [
            'topUsers' => $topUsers,
            'users' => $users
        ]);
    }
}