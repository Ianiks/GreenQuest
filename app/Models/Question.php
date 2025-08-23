<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'quiz_id',      // link to the quiz
        'question_text',         // question text
        'correct_answer' // correct answer index
    ];
    

    // Relation to Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Relation to Answers
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
