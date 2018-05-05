<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Document;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit the document.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Document  $document
     * @return mixed
     */
    public function edit(User $user, Document $document)
    {
        return $user->id == $document->user_id;
    }

    /**
     * Determine whether the user can update the document.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Document  $document
     * @return mixed
     */
    public function update(User $user, Document $document)
    {
        return $user->id == $document->user_id;
    }

    /**
     * Determine whether the user can delete the document.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Document  $document
     * @return mixed
     */
    public function delete(User $user, Document $document)
    {
        return $user->id = $document->user_id;
    }
}
