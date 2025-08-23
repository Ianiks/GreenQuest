<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id_number',
        'email',
        'firstname',
        'lastname',
        'password',
        'points',
        'trees_planted',
        'carbon_saved',
        'games_completed',
        'trivia_progress',
        'waste_sorting_progress',
        'eco_plan_progress',
        'is_active',
        'is_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'is_admin' => 'boolean'
    ];

    public function getAuthIdentifierName()
    {
        return 'id_number';
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // Helper method to calculate potential trees
    public function getPotentialTreesAttribute()
    {
        return floor($this->points / 20);
    }

    // Helper method for total environmental impact
    public function getTotalImpactAttribute()
    {
        return $this->trees_planted + $this->potential_trees;
    }

    public function instructor()
{
    return $this->belongsTo(Instructor::class, 'instructor_id');
}

}