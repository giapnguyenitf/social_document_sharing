<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getAll()
    {
        return $this->paginate(config('settings.user.paginate'));
    }

    public function getAllUsers()
    {
        return $this->where('rules', config('settings.rules.is_user'))->paginate(config('settings.user.paginate'));
    }

    public function getAllModerators()
    {
        return $this->where('rules', config('settings.rules.is_moderator'))->paginate(config('settings.user.paginate'));
    }
}
