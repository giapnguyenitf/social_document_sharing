<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user, User $model)
    {
        return $user->id == $model->id;
    }

    public function create(User $user)
    {
        return false;
    }

    public function block(User $user, User $model)
    {
        if ($model->isModerator()) {
            return false;
        }

        return true;
    }

    public function before(User $user)
    {
        if ($user->isAdmin())
        {
            return true;
        }
    }
}
