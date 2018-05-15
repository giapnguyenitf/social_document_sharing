<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tag extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document_tag', 'tag_id', 'document_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'maxLength' => 50,
            ]
        ];
    }
}
