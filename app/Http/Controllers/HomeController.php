<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recentGames = Game::latest()->take(6)->get();

        return view('public.home', compact('recentGames'));
    }
}
