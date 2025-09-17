<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizQuestion;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = QuizQuestion::where('instructor_id', auth()->id())->get();
        return view('instructor.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('instructor.quizzes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'question' => 'required|string',
            'choice1' => 'required|string',
            'choice2' => 'required|string',
            'choice3' => 'required|string',
            'choice4' => 'required|string',
            'correct_answer' => 'required|string',
            'level' => 'nullable|string',
            'difficulty' => 'nullable|string',
            'category' => 'nullable|string',
        ]);

        QuizQuestion::create(array_merge(
            $request->only([
                'title', 'question', 'choice1', 'choice2', 'choice3', 'choice4',
                'correct_answer', 'level', 'difficulty', 'category'
            ]),
            ['instructor_id' => auth()->id()]
        ));

        return redirect()->route('instructor.quizzes.index')->with('success', 'Quiz created successfully.');
    }

    public function edit($quizId)
    {
        $quiz = QuizQuestion::findOrFail($quizId);
        return view('instructor.quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, $quizId)
    {
        $quiz = QuizQuestion::findOrFail($quizId);

        $request->validate([
            'title' => 'required|string|max:255',
            'question' => 'required|string',
            'choice1' => 'required|string',
            'choice2' => 'required|string',
            'choice3' => 'required|string',
            'choice4' => 'required|string',
            'correct_answer' => 'required|string',
            'level' => 'nullable|string',
            'difficulty' => 'nullable|string',
            'category' => 'nullable|string',
        ]);

        $quiz->update($request->only([
            'title', 'question', 'choice1', 'choice2', 'choice3', 'choice4',
            'correct_answer', 'level', 'difficulty', 'category'
        ]));

        return redirect()->route('instructor.quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy($quizId)
    {
        $quiz = QuizQuestion::findOrFail($quizId);
        $quiz->delete();

        return redirect()->route('instructor.quizzes.index')->with('success', 'Quiz deleted successfully.');
    }
}
