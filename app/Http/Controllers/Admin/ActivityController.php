<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserActivity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = UserActivity::with(['user', 'game'])
            ->latest()
            ->paginate(15);

        return view('admin.activities.index', compact('activities'));
    }

    public function show(UserActivity $activity)
    {
        return view('admin.activities.show', compact('activity'));
    }

    public function destroy(UserActivity $activity)
    {
        $activity->delete();
        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity record deleted successfully');
    }
}