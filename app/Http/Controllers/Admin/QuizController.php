<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz; // If you have a Quiz model

class QuizController extends Controller
{
    public function create()
    {
        Question::create([
    'quiz_id' => $quiz->id,
    'question_text' => $requestQuestion['text'], // <--- must be included
    'correct_answer' => $requestQuestion['correct'],
]);

        return view('admin.quizzes.create');
    }

    public function store(Request $request)
    {
        // Add validation and quiz creation logic here
        return redirect()->route('admin.dashboard')->with('success', 'Quiz created successfully!');
    }
}