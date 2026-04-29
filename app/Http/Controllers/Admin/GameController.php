<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::latest()->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'genre' => 'nullable|string|max:80',
            'platform' => 'nullable|string|max:80',
            'release_year' => 'nullable|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('covers', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        Game::create($validated);

        return redirect()->route('admin.games.index')->with('success', 'Game berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'genre' => 'nullable|string|max:80',
            'platform' => 'nullable|string|max:80',
            'release_year' => 'nullable|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cover_focus_x' => 'integer',
            'cover_focus_y' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            if ($game->image_url) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $game->image_url));
            }
            $path = $request->file('image')->store('covers', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        $game->update($validated);

        return redirect()->route('admin.games.index')->with('success', 'Game berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        if ($game->image_url) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $game->image_url));
        }
        $game->delete();

        return redirect()->route('admin.games.index')->with('success', 'Game berhasil dihapus!');
    }
}
