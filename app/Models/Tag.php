<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function walktag()
    {
        return $this->hasMany(Walktag::class, 'tag_id', 'id');
    }
}
