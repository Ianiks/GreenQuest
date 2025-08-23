<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;

class InstructorController extends Controller
{
    // =========================
    // Dashboard
    // =========================
    public function dashboard()
    {
        $instructor = Auth::guard('instructor')->user();

        // Fetch students assigned to this instructor
        $students = $instructor->students()->get();

        // Calculate stats
        $totalPoints = $students->sum('points'); 
        $treesToPlant = floor($totalPoints / 20);

        // Prepare recent activities
        $recentActivities = $students->map(function ($student) {
            return [
                'name' => $student->firstname . ' ' . $student->lastname,
                'activity' => 'Completed a game',
                'points_earned' => $student->points ?? 0,
                'updated_at' => $student->updated_at,
            ];
        })->sortByDesc('updated_at')->take(10);

        $stats = [
            'total_students' => $students->count(),
            'active_students' => $students->where('is_active', 1)->count(),
            'total_points' => $totalPoints,
            'trees_to_plant' => $treesToPlant,
            'recent_activities' => $recentActivities,
        ];

        return view('instructor.dashboard', compact('stats', 'students'));
    }

    // =========================
    // Students
    // =========================
    public function students()
    {
        $instructor = Auth::guard('instructor')->user();
        $students = $instructor->students()->get();
        return view('instructor.students', compact('students'));
    }

    public function importStudents(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new StudentsImport, $request->file('file'));

        return redirect()->route('instructor.students')->with('success', 'Students imported successfully.');
    }

    // =========================
    // Quizzes
    // =========================
    public function quizzes()
    {
        $easyQuizzes = Quiz::where('difficulty', 'easy')->get();
        $moderateQuizzes = Quiz::where('difficulty', 'moderate')->get();
        $difficultQuizzes = Quiz::where('difficulty', 'difficult')->get();

        return view('instructor.quizzes.index', compact('easyQuizzes', 'moderateQuizzes', 'difficultQuizzes'));
    }

    public function createQuiz()
    {
        return view('instructor.quizzes.create');
    }

    public function storeQuiz(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'difficulty' => 'required|in:easy,moderate,difficult',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.answers' => 'required|array|min:2',
            'questions.*.answers.*.text' => 'required|string',
            'questions.*.correct_answer' => 'required'
        ]);

      $quiz = Quiz::create([
    'title' => $request->title,
    'difficulty' => $request->difficulty,
    'instructor_id' => Auth::guard('instructor')->id(), // <-- required
]);

        // Loop through questions
        foreach ($request->questions as $qData) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $qData['text'],
            ]);

            // Loop answers
            foreach ($qData['answers'] as $index => $aData) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $aData['text'],
                    'is_correct' => ($qData['correct_answer'] == $index) ? 1 : 0,
                ]);
            }
        }

        return redirect()->route('instructor.quizzes.index')
            ->with('success', 'Quiz created successfully with questions and answers!');
    }
}
