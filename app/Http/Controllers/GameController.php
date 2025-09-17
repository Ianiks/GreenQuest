<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /**
     * Trivia Game (Easy)
     */
public function trivia(Request $request)
{
    $difficulty = $request->query('difficulty', 'easy');

    // Fetch questions from DB with all required fields
    $dbQuestionBank = \DB::table('quizquestions')
        ->where('difficulty', $difficulty)
        ->select(
            'id',
            'question',
            'choice1',
            'choice2',
            'choice3',
            'choice4',
            'correct_answer',
            'level'
        )
        ->get()
        ->groupBy('level'); // group by level for multiple levels

    return view('games.trivia', [
        'dbQuestionBank' => $dbQuestionBank
    ]);
}


    /**
     * Waste Sorting Game (Moderate)
     */
    public function wasteSortingQuiz(Request $request)
    {
        return $this->loadGame(
            $request,
            category: 'waste',
            difficulty: 'moderate',
            view: 'games.waste-sorting-quiz',
            sessionKey: 'waste_sorting_correct'
        );
    }

    /**
     * Eco Plan Game (Difficult)
     */
    public function ecoPlan(Request $request)
    {
        return $this->loadGame(
            $request,
            category: 'eco',
            difficulty: 'difficult',
            view: 'games.eco-plan',
            sessionKey: 'eco_plan_correct'
        );
    }

    /**
     * Generic Loader for All Games
     */
    private function loadGame(Request $request, string $category, string $difficulty, string $view, string $sessionKey)
    {
        $query = DB::table('quizquestions')
            ->where('category', $category)
            ->where('difficulty', $difficulty);

        // ✅ Filter by access code if provided
        if ($request->has('access_code')) {
            $query->where('access_code', $request->access_code);
        }

        $raw = $query->select(
            'id',
            'title',
            'instructor_id',
            'level',
            'question',
            'choice1',
            'choice2',
            'choice3',
            'choice4',
            'correct_answer',
            'access_code',
            'quiz_id'
        )->orderBy('level')->get();

        if ($raw->isEmpty()) {
            return redirect()->route('dashboard')
                ->with('error', "No {$category} ({$difficulty}) questions available.");
        }

        // ✅ Group questions by level
        $dbQuestions = [];
        $correct = [];
        $levelAccessCodes = [];
        $quizTitles = [];

        foreach ($raw as $qIndex => $q) {
            $dbQuestions[$q->level][] = [
                'id'       => $q->id,
                'question' => $q->question,
                'options'  => [$q->choice1, $q->choice2, $q->choice3, $q->choice4],
                'correct'  => (int) $q->correct_answer - 1, // 0-based index
                'quiz_id'  => $q->quiz_id,
            ];

            $correct[$q->level . '_' . $qIndex] = (int) $q->correct_answer - 1;
            $levelAccessCodes[$q->level] = $q->access_code;
            $quizTitles[$q->level] = $q->title;
        }

        // ✅ Save answers for scoring
        session()->put($sessionKey, $correct);

        return view($view, [
            'dbQuestionBank'   => $dbQuestions,
            'difficulty'       => $difficulty,
            'category'         => $category,
            'levelAccessCodes' => $levelAccessCodes,
            'quizTitles'       => $quizTitles
        ]);
    }

    /**
     * Submissions
     */
    public function submitTrivia(Request $request)
    {
        return $this->calculateScore($request, 'trivia_correct', 'games.trivia-result');
    }

    public function submitWasteSortingQuiz(Request $request)
    {
        return $this->calculateScore($request, 'waste_sorting_correct', 'games.result');
    }

    public function submitEcoPlan(Request $request)
    {
        return $this->calculateScore($request, 'eco_plan_correct', 'games.result');
    }

    /**
     * Generic Scoring Logic
     */
    private function calculateScore(Request $request, string $sessionKey, string $view)
    {
        $correctAnswers = session($sessionKey, []);
        $score = 0;

        foreach ($correctAnswers as $key => $correct) {
            $userAnswer = $request->input("answer_$key");
            if ((int) $userAnswer === (int) $correct) {
                $score++;
            }
        }

        session()->forget($sessionKey);

        return view($view, [
            'score' => $score,
            'total' => count($correctAnswers),
        ]);
    }
}
