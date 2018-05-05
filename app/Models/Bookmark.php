<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'user_id',
        'document_id',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class)->withTrashed();
    }
}
