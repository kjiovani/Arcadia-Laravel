<?php

namespace App\Models;

use Dom\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $fillable = [
        'title',
        'genre',
        'platform',
        'release_year',
        'image_url',
        'description',
        'image_original_url',
        'cover_focus_x',
        'cover_focus_y'
    ];

    public function walkthrough(): HasMany
    {
        return $this->hasMany(Walkthrough::class, 'game_id', 'id');
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class, 'game_id', 'id');
    }
}
