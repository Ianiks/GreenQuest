<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz; // make sure you have a Quiz model

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch quizzes by difficulty
        $easyQuizzes = Quiz::where('difficulty', 'easy')->get();
        $moderateQuizzes = Quiz::where('difficulty', 'moderate')->get();
        $difficultQuizzes = Quiz::where('difficulty', 'difficult')->get();

        return view('dashboard', [
            'totalPoints' => $user->points ?? 0,
            'completedQuests' => $user->completed_quests ?? 0,
            'upcomingEvents' => 'Tree Planting - June 5',
            'carbonSaved' => $user->carbon_saved ?? '0 kg',

            // Pass quizzes to the view
            'easyQuizzes' => $easyQuizzes,
            'moderateQuizzes' => $moderateQuizzes,
            'difficultQuizzes' => $difficultQuizzes,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
