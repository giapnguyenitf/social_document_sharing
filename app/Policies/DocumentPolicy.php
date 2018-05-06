<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Document;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Document $document)
    {
        if ($document->isPublished()) {
            return true;
        }

        if ($document->isChecking() || $document->isIllegal()) {
            return $user->id == $document->user_id;
        }
    }

    public function edit(User $user, Document $document)
    {
        return $user->id == $document->user_id;
    }

    public function update(User $user, Document $document)
    {
        return $user->id == $document->user_id;
    }

    public function delete(User $user, Document $document)
    {
        return $user->id = $document->user_id;
    }

    public function before(User $user)
    {
        if ($user->isAdmin() || $user->isModerator())
        {
            return true;
        }
    }
}
