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
            $hours = $now->diffInHours($commentAt);
            $days = $now->diffInDays($commentAt);
            $weeks = $now->diffInWeeks($commentAt);
            $months = $now->diffInMonths($commentAt);
            $years = $now->diffInYears($commentAt);

            if ($minutes < 60) {
                return $minutes . ' ' . trans('user.comment.minutes_ago');
            } else if ($hours < 24) {
                return $hours . ' ' . trans('user.comment.hours_ago');
            } else if ($days < 7) {
                return $days . ' ' . trans('user.comment.days_ago');
            } else if ($weeks < 4) {
                return $weeks . ' ' . trans('user.comment.weeks_ago');
            } else if ($months < 12) {
                return $months . ' ' . trans('user.comment.months_ago');
            } else {
                return $years. ' ' . trans('user.commet.years_ago');
            }
        }

        return 0 . ' ' . trans('user.comment.minutes_ago');
    }
}
