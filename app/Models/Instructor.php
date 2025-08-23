<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Instructor extends Authenticatable
{
    protected $fillable = [
        'id_number',
        'firstname',
        'lastname',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function students()
    {
        return $this->hasMany(\App\Models\User::class, 'instructor_id');
    }
}
