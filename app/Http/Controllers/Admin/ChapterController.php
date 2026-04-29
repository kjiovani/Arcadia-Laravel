<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Walkthrough;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($walk_id)
    {
        $walkthrough = Walkthrough::findOrFail($walk_id);
        $chapters = Chapter::where('walk_id', $walk_id)->orderBy('order_number')->get();

        return view('admin.chapters.index', compact('walkthrough', 'chapters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $walk_id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'nullable|string',
            'order_number' => 'required|integer',
            'youtube_url' => 'nullable|url',
        ]);

        $validated['walk_id'] = $walk_id;
        Chapter::create($validated);

        return back()->with('success', 'Bab baru berhasil ditambahkan!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
