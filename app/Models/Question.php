<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'quizquestions'; // <-- important, since you’re using this table

    protected $fillable = [
        'quiz_id',
        'question',
        'choice1',
        'choice2',
        'choice3',
        'choice4',
        'correct_answer',
        'level',
        'difficulty',
        'access_code',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
