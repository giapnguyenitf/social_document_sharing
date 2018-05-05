<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $with = ['user'];

    protected $appends = ['comment_at'];

    protected $fillable = [
        'user_id',
        'document_id',
        'messages',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCommentAtAttribute()
    {
        if (!empty($this->created_at)) {
            $now = Carbon::now();
            $commentAt = Carbon::parse($this->created_at);
            $minutes = $now->diffInMinutes($commentAt);

            if ($minutes < 60) {
                return $minutes . ' ' . trans('user.comment.minutes_ago');
            } else {
                $hour = $now->diffInHours($commentAt);

                if ($hour <24 ) {
                    return $hour . ' ' . trans('user.comment.hours_ago');
                }

                return $hour/24 . ' ' . trans('user.comment.days_ago');
            }
        }

        return 0 . ' ' . trans('user.comment.minutes_ago');
    }
}
