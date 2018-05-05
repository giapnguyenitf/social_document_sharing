<?php

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\RepositoryInterface;

interface BookmarkRepositoryInterface extends RepositoryInterface
{
    public function isBookmark($userId, $documentId);

    public function getByUser($userId);
}
