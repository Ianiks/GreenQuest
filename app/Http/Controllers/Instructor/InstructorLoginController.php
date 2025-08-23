<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Instructor;

class InstructorLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('instructor.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'id_number' => 'required',
            'password' => 'required',
        ]);

        $instructor = Instructor::where('id_number', $request->id_number)
                        ->where('password', $request->password) // plain-text check
                        ->first();

        if ($instructor) {
            Auth::guard('instructor')->login($instructor);
            return redirect()->route('instructor.dashboard');
        }

        return back()->withErrors(['id_number' => 'Invalid ID number or password.']);
    }

    public function logout()
    {
        Auth::guard('instructor')->logout();
        return redirect()->route('instructor.login');
    }
}
