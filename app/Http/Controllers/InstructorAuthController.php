<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;

class InstructorAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'id_number' => 'required|string',
            'password' => 'required|string',
        ]);

        $instructor = Instructor::where('id_number', $request->id_number)->first();

        if ($instructor && strtolower($instructor->lastname) === strtolower($request->password)) {
            Auth::guard('instructor')->login($instructor);
            return redirect()->route('instructor.dashboard')
                ->with('success', 'Welcome Instructor ' . $instructor->firstname . '!');
        }

        return back()->withErrors(['id_number' => 'Invalid ID number or password.']);
    }
}
