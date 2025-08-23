<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }
public function store(Request $request)
{
    $request->validate([
        'id_number' => 'required|string|unique:users',
        'email' => 'nullable|email|unique:users',
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
        'is_active' => 'sometimes|boolean'
    ]);

    User::create([
        'id_number' => $request->id_number,
        'email' => $request->email, // Now included but optional
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'password' => Hash::make($request->password),
        'is_active' => $request->is_active ?? true
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
}


   public function show(User $user)
{
 
    
    return view('admin.users.show', compact('user'));
}
 public function edit(User $user)
{
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $request->validate([
        'id_number' => 'required|string|unique:users,id_number,'.$user->id,
        'email' => 'nullable|email|unique:users,email,'.$user->id,
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'is_active' => 'sometimes|boolean'
    ]);

    $user->update([
        'id_number' => $request->id_number,
        'email' => $request->email,
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'is_active' => $request->is_active ?? $user->is_active
    ]);

    return redirect()->route('admin.users.index')
        ->with('success', 'User updated successfully!');
}


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }

    public function export()
    {
        // Export logic here
        return response()->download('path/to/export.csv');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $userIds = $request->input('selected_users', []);

        if ($action === 'activate') {
            User::whereIn('id', $userIds)->update(['is_active' => true]);
            return back()->with('success', 'Selected users activated!');
        } elseif ($action === 'deactivate') {
            User::whereIn('id', $userIds)->update(['is_active' => false]);
            return back()->with('success', 'Selected users deactivated!');
        } elseif ($action === 'delete') {
            User::whereIn('id', $userIds)->delete();
            return back()->with('success', 'Selected users deleted!');
        }

        return back()->with('error', 'Invalid action!');
    }
}
