<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Walkthrough extends Model
{
    protected $fillable = [
        'game_id',
        'title',
        'overview',
        'difficulty',
        'cover_url',
        'cover_focus_x',
        'cover_focus_y',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function chapter(): HasMany
    {
        return $this->hasMany(Chapter::class, 'walk_id', 'id');
    }

    public function walktag(): HasMany
    {
        return $this->hasMany(Walktag::class, 'walk_id', 'id');
    }
}
