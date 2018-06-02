<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNotificationAtAttribute()
    {
        if (!empty($this->created_at)) {
            $now = Carbon::now();
            $createAt = Carbon::parse($this->created_at);
            $minutes = $now->diffInMinutes($createAt);
            $hours = $now->diffInHours($createAt);
            $days = $now->diffInDays($createAt);
            $weeks = $now->diffInWeeks($createAt);
            $months = $now->diffInMonths($createAt);
            $years = $now->diffInYears($createAt);

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
