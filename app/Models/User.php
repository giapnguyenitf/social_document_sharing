<?php

namespace App\Models;

use Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model implements Authenticatable
{
    use AuthenticableTrait;

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

    protected $hidden = [
        'password', 'remember_token',
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

    public function getAvatarPathAttribute()
    {
        if ($this->attributes['provider']) {
            return $this->attributes['avatar'];
        }

        return Storage::url($this->attrbutes['avatar']);
    }
}
