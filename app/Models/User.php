<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'rules',
        'date_of_birth',
        'address',
        'phone',
        'gender',
        'avatar',
        'is_ban',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function isAdmin()
    {
        return $this->rules == config('settings.rules.is_admin');
    }

    public function isModerator()
    {
        return $this->rules == config('settings.rules.is_moderator');
    }

    public function getUserTypeAttribute()
    {
        if ($this->provider) {
            return $this->provider;
        }

        return trans('admin.normal');
    }
}
