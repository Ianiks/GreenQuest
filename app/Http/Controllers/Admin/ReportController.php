<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $reports = [
            'daily_activities' => UserActivity::whereDate('created_at', today())->count(),
            'weekly_activities' => UserActivity::whereBetween('created_at', 
                [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'monthly_activities' => UserActivity::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)->count(),
            'total_users' => User::count(),
            'top_users' => $this->getTopUsers(),
            'monthly_activity_labels' => $this->getMonthlyActivityLabels(),
            'monthly_activity_data' => $this->getMonthlyActivityData(),
            'total_trees_planted' => $this->calculateTotalTrees(),
            'trees_from_points' => $this->calculateTreesFromPoints()
        ];

        return view('admin.reports.index', compact('reports'));
    }

    protected function getTopUsers($limit = 5)
    {
        return User::select('id', 'firstname', 'lastname', 'points', 'trees_planted')
            ->orderByDesc('points')
            ->limit($limit)
            ->get()
            ->map(function ($user) {
                return (object) [
                    'name' => $user->firstname . ' ' . $user->lastname,
                    'avatar_url' => asset('images/default-avatar.png'),
                    'points' => $user->points,
                    'total_trees' => $user->trees_planted + floor($user->points / 10)
                ];
            });
    }

    protected function getMonthlyActivityLabels()
    {
        return collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->format('M');
        })->toArray();
    }

    protected function getMonthlyActivityData()
    {
        return collect(range(1, 12))->map(function ($month) {
            return UserActivity::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count();
        })->toArray();
    }

    protected function calculateTotalTrees()
    {
        $directTrees = User::sum('trees_planted');
        $pointsTrees = floor(User::sum('points') / 10);
        return $directTrees + $pointsTrees;
    }

    protected function calculateTreesFromPoints()
    {
        return floor(User::sum('points') / 10);
    }

    public function plantedTreesReport(Request $request)
    {
        $validated = $request->validate([
            'period' => 'required|in:today,week,month,year,custom',
            'type' => 'sometimes|in:summary,detailed',
            'from_date' => 'required_if:period,custom|date',
            'to_date' => 'required_if:period,custom|date'
        ]);

        $query = User::query();

        switch ($validated['period']) {
            case 'today':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->whereBetween('created_at', 
                    [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
            case 'custom':
                $query->whereBetween('created_at', 
                    [$validated['from_date'], $validated['to_date']]);
                break;
        }

        $totalUsers = $query->count();
        $directTrees = $query->sum('trees_planted');
        $pointsTrees = floor($query->sum('points') / 10);
        $totalTrees = $directTrees + $pointsTrees;

        return response()->json([
            'success' => true,
            'data' => [
                'total_trees' => $totalTrees,
                'direct_trees' => $directTrees,
                'trees_from_points' => $pointsTrees,
                'total_users' => $totalUsers,
                'avg_trees_per_user' => $totalUsers > 0 ? round($totalTrees / $totalUsers, 2) : 0,
                'chart_data' => [
                    'labels' => ['Direct Planting', 'Points Conversion'],
                    'datasets' => [[
                        'data' => [$directTrees, $pointsTrees],
                        'backgroundColor' => ['#28a745', '#17a2b8']
                    ]]
                ]
            ]
        ]);
    }
}
