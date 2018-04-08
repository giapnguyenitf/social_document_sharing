<?php

namespace App\Repositories\Eloquent;

use App\Models\Bookmark;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\BookmarkRepositoryInterface;

class BookmarkRepository extends BaseRepository implements BookmarkRepositoryInterface
{
    public function getModel()
    {
        return Bookmark::class;
    }
}
