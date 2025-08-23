<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'difficulty',
        'instructor_id'  // <-- allow mass assignment
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}


