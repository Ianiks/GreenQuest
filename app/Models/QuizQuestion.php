<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $table = 'quizquestions';

    protected $fillable = [
        'question',
        'choice1',
        'choice2',
        'choice3',
        'choice4',
        'correct_answer',
        'level',
        'difficulty',
        'access_code',
        'quiz_id',
        'category',
        'title',
        'instructor_id',
    ];

    public $timestamps = true; // ✅ now created_at and updated_at will auto-fill
}
