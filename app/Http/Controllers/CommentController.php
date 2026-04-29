<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $game_id)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Comment::create([
            'game_id' => $game_id,
            'user_id' => User::id(),
            'body' => $request->body,
            'status' => 'PUBLISHED'
        ]);

        return back()->with('success', 'Komentarmu berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (User::id() === $comment->user_id || User::user()->isAdmin()) {
            $comment->delete();
            return back()->with('success', 'Komentar berhasil dihapus.');
        }

        abort(403, 'Kamu tidak memiliki izin untuk menghapus komentar ini.');
    }
}
