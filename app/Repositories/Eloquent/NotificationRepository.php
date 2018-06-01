<?php

namespace App\Repositories\Eloquent;

use App\Models\Notification;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\NotificationRepositoryInterface;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    public function getModel()
    {
        return Notification::class;
    }

    public function getAll($userId)
    {
        return $this->model->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }
}
