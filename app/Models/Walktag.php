<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Walktag extends Model
{
    protected $fillable = [
        'walk_id',
        'tag_id'
    ];

    public function walkthrough()
    {
        return $this->belongsTo(Walkthrough::class, 'walk_id', 'id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }
}
