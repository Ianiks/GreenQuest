<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index() {
        $quizzes = Quiz::where('instructor_id', auth()->id())->latest()->get();
        return view('instructor.quizzes.index', compact('quizzes'));
    }

    public function create() {
        return view('instructor.quizzes.create');
    }

   public function store(Request $request)
{
    $quiz = Quiz::create([
        'title' => $request->title,
        'difficulty' => $request->difficulty,
    ]);

    foreach ($request->questions as $qIndex => $qData) {
        $question = $quiz->questions()->create([
            'text' => $qData['text'],
        ]);

        foreach ($qData['answers'] as $aIndex => $aData) {
            $question->answers()->create([
                'text' => $aData['text'],
                'is_correct' => ($qIndex == $qIndex && $aIndex == $qData['correct']),
            ]);
        }
    }

    return redirect()->route('instructor.quizzes.index')->with('success', 'Quiz created!');
}


    public function edit(Quiz $quiz) {
        return view('instructor.quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz) {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $quiz->update(['title' => $request->title]);

        return redirect()->route('instructor.quizzes.index')->with('success', 'Quiz updated successfully!');
    }

    public function destroy(Quiz $quiz) {
        $quiz->delete();
        return back()->with('success', 'Quiz deleted successfully!');
    }
}
