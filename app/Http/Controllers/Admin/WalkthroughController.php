<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Walkthrough;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WalkthroughController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $walkthroughs = Walkthrough::with('game')->latest()->paginate(10);
        return view('admin.walkthroughs.index', compact('walkthroughs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $games = Game::orderBy('title')->get();
        return view('admin.walkthroughs.create', compact('games'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'title' => 'required|string|max:150',
            'overview' => 'nullable|string',
            'difficulty' => 'required|in:Easy,Medium,Hard',
        ]);

        Walkthrough::create($validated);

        return redirect()->route('admin.walkthroughs.index')->with('success', 'Panduan berhasil dibuat!');
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
    public function edit(Walkthrough $walkthrough)
    {
        return view('admin.walkthroughs.edit', compact('walkthrough', 'games'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Walkthrough $walkthrough)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'title' => 'required|string|max:150',
            'overview' => 'nullable|string',
            'difficulty' => 'required|in:Easy,Medium,Hard',
            'cover_url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cover_focus_x' => 'integer',
            'cover_focus_y' => 'integer',
        ]);

        if ($request->hasFile('cover_url')) {
            if ($walkthrough->cover_url) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $walkthrough->cover_url));
            }
            $path = $request->file('cover_url')->store('walkthrough_covers', 'public');
            $validated['cover_url'] = '/storage/' . $path;
        }

        $walkthrough->update($validated);

        return redirect()->route('admin.walkthroughs.index')->with('success', 'Panduan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Walkthrough $walkthrough)
    {
        if ($walkthrough->cover_url) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $walkthrough->cover_url));
        }

        $walkthrough->delete();

        return redirect()->route('admin.walkthroughs.index')->with('success', 'Panduan berhasil dihapus!');
    }
}
