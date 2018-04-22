<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'file_name',
        'description',
        'file_size',
        'file_type',
        'thumbnail',
        'views',
        'downloads',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function getStatusAttribute()
    {
        switch ($this->attributes['status']) {
            case config('settings.document.status.is_illegal'):
                return trans('user.document.status.is_illegal');
            case config('settings.document.status.is_checking'):
                return trans('user.document.status.is_checking');
            case config('settings.document.status.is_published'):
                return trans('user.document.status.is_published');
            default:
                return trans('user.document.status.is_published');
        }
    }
}
