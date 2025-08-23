<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('instructor.login'); // Your login blade
    }

    public function login(Request $request)
    {
        $request->validate([
            'id_number' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('id_number', 'password');

        if (Auth::guard('instructor')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('instructor.dashboard');
        }

        return back()->withErrors([
            'id_number' => 'Invalid ID number or password',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('instructor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('instructor.login');
    }
}
