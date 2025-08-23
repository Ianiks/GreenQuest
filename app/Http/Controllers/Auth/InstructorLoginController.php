<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Instructor;

class InstructorLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('instructor.login'); // your login blade
    }

    public function login(Request $request)
    {
        $request->validate([
            'id_number' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('id_number', 'password');

        if (Auth::guard('instructor')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('instructor.dashboard');
        }

        return back()->withErrors([
            'id_number' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('instructor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('instructor.login');
    }
}
