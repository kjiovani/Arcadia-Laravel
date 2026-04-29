<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    protected $fillable = [
        'walk_id',
        'title',
        'content',
        'order_number',
        'youtube_url',
        'image_url',
    ];

    public function walkthrough(): BelongsTo
    {
        return $this->belongsTo(Walkthrough::class, 'walk_id', 'id');
    }
}
