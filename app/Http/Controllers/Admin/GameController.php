<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::latest()->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        return view('admin.games.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty' => 'required|in:easy,moderate,difficult',
            'points' => 'required|integer|min:1',
            'carbon_saved' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        Game::create($validated);

        return redirect()->route('admin.games.index')
            ->with('success', 'Game created successfully');
    }

    public function show(Game $game)
    {
        return view('admin.games.show', compact('game'));
    }

    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty' => 'required|in:easy,moderate,difficult',
            'points' => 'required|integer|min:1',
            'carbon_saved' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $game->update($validated);

        return redirect()->route('admin.games.index')
            ->with('success', 'Game updated successfully');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('admin.games.index')
            ->with('success', 'Game deleted successfully');
    }
}