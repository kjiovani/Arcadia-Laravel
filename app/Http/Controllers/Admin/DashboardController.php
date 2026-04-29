<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Game;
use App\Models\User;
use App\Models\Walkthrough;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_games' => Game::count(),
            'total_walkthroughs' => Walkthrough::count(),
            'total_users' => User::count(),
            'total_comments' => Comment::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
