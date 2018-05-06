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
        return $this->where('is_ban', config('settings.is_ban.false'))
            ->where('rules', config('settings.rules.is_user'))
            ->get();
    }

    public function getAllModerators()
    {
        return $this->where('rules', config('settings.rules.is_moderator'))
            ->where('is_ban', config('settings.is_ban.false'))
            ->get();
    }

    public function getAllBlockedUsers()
    {
        return $this->where('is_ban', config('settings.is_ban.true'))
            ->where('rules', config('settings.rules.is_user'))
            ->get();
    }

    public function getAllBlockedMods()
    {
        return $this->where('rules', config('settings.rules.is_moderator'))
            ->where('is_ban', config('settings.is_ban.true'))
            ->get();
    }
}
