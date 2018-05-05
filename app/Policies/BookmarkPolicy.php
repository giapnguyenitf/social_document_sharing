<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bookmark;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookmarkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the bookmark.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bookmark  $bookmark
     * @return mixed
     */
    public function delete(User $user, Bookmark $bookmark)
    {
        return $user->id == $bookmark->user_id;
    }
}
