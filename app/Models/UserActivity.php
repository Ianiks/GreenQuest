<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/UserActivity.php

class UserActivity extends Model
{
    protected $fillable = ['user_id']; // Add this after creating the column
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

