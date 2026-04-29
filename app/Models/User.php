<?php

namespace App\Models;

use Dom\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'full_name',
        'username',
        'email',
        'password',
        'role',
        'avatar_url',
        'banner_url',
        'bio',
        'is_active',
        'last_login_at'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'last_login_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'ADMIN';
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}
