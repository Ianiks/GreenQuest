<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuizQuestion; // ✅ use QuizQuestion model

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ✅ Fetch quizzes/questions by difficulty from quizquestions table
        $easyQuizzes = QuizQuestion::where('difficulty', 'easy')->get();
        $moderateQuizzes = QuizQuestion::where('difficulty', 'moderate')->get();
        $difficultQuizzes = QuizQuestion::where('difficulty', 'difficult')->get();

        return view('dashboard', [
            'totalPoints'      => $user->points ?? 0,
            'completedQuests'  => $user->completed_quests ?? 0,
            'upcomingEvents'   => 'Tree Planting - June 5',
            'carbonSaved'      => $user->carbon_saved ?? '0 kg',

            // ✅ Pass quizzes to the view
            'easyQuizzes'      => $easyQuizzes,
            'moderateQuizzes'  => $moderateQuizzes,
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
