<?php 

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;

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
        $request->validate([
            'title' => 'required|string|max:255',
            'difficulty' => 'required|in:easy,moderate,difficult',
            'access_code' => 'required|string|max:255|unique:quizzes,access_code',
            'level' => 'required|integer|min:1',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string|max:255',
            'questions.*.answers' => 'required|array|size:4',
            'questions.*.answers.*.text' => 'required|string|max:255',
            'questions.*.correct' => 'required|integer|between:0,3',
        ]);

        // Create quiz
        $quiz = Quiz::create([
            'title' => $request->title,
            'difficulty' => $request->difficulty,
            'level' => $request->level,
            'access_code' => $request->access_code,
            'instructor_id' => auth()->id(),
        ]);

        // Save questions
        foreach ($request->questions as $qData) {
            Question::create([
                'quiz_id'        => $quiz->id,
                'question'       => $qData['text'],
                'choice1'        => $qData['answers'][0]['text'],
                'choice2'        => $qData['answers'][1]['text'],
                'choice3'        => $qData['answers'][2]['text'],
                'choice4'        => $qData['answers'][3]['text'],
                'correct_answer' => $qData['correct'],
                'level'          => $request->level,
                'difficulty'     => $request->difficulty,
                'access_code'    => $request->access_code,
            ]);
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

        $quiz->update([
            'title' => $request->title,
        ]);

        return redirect()->route('instructor.quizzes.index')->with('success', 'Quiz updated successfully!');
    }

    public function destroy(Quiz $quiz) {
        // Delete related questions
        $quiz->questions()->delete();

        // Delete quiz
        $quiz->delete();

        return back()->with('success', 'Quiz and its questions deleted successfully!');
    }
}
