<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function getModel()
    {
        return Document::class;
    }
}
