<?php

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\RepositoryInterface;

interface NotificationRepositoryInterface extends RepositoryInterface
{
    public function getAll($userId);
}
