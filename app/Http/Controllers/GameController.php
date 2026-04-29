<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $games = Game::when($request->q, function($query, $q) {
            return $query->where('title', 'like', "%{$q}%")
                         ->orWhere('description', 'like', "%{$q}%");
        })->paginate(12);
    }

    public function show($id)
    {
        $game = Game::with(['walkthroughs', 'publishedComments.user'])->findOrFail($id);

        return view('public.games.show', compact('game'));
    }
}
