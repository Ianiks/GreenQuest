<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Regular User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register'); // Regular user registration view
    }

    public function register(Request $request)
    {
        $request->validate([
            'id_number' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            // Add other fields (firstname, lastname, etc.)
        ]);

        $user = User::create([
            'id_number' => $request->id_number,
            'password' => Hash::make($request->password),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'role' => 'user', // Explicitly set role
        ]);

        Auth::login($user); // Use default guard (web)

        return redirect()->route('user.dashboard'); // Redirect to USER dashboard
    }
}