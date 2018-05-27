<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'document_id',
        'type',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function getTypeReportAttribute()
    {
        switch ($this->attributes['type']) {
            case '1':
                return trans('user.report_document.type.1');
            case '2':
                return trans('user.report_document.type.2');
            case '3':
                return trans('user.report_document.type.3');
            case '4':
                return trans('user.report_document.type.4');
            case '5':
                return trans('user.report_document.5');
            case '6':
                return trans('user.report_document.6');
            default:
                return trans('user.report_document.type.1');
        }
    }

    public function getStatusNameAttribute()
    {
        if ($this->attributes['status'] == 0) {
            return config('admin.report.unread');
        }

        return config('admin.report.read');
    }
}
