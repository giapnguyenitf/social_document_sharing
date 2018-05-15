<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes, Sluggable, Searchable;

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
        'slug',
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

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'document_tag', 'document_id', 'tag_id');
    }

    public function getStatusNameAttribute()
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

    public function getDownloadLinkAttribute()
    {
        return public_path($this->file_name);
    }

     public function isChecking()
    {
        return $this->status == config('settings.document.status.is_checking');
    }

    public function isPublished()
    {
        return $this->status == config('settings.document.status.is_published');
    }

    public function isIllegal()
    {
        return $this->status == config('settings.document.status.is_illegal');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'includeTrashed' => true,
                'maxLength' => 191,
            ]
        ];
    }

    public function toSearchableArray()
    {
        $record = $this->toArray();
        $record['name'] = $this->name;
        $record['description'] = $this->description;

        return $record;
    }

    public function shouldBeSearchable()
    {
        return $this->isPublished();
    }
}
