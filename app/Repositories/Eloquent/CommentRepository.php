<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function getModel()
    {
        return Comment::class;
    }

    public function getComment($documentId)
    {
        return $this->model->where('document_id', $documentId)->orderBy('created_at','desc')->paginate(config('settings.comment.paginate'));
    }
}
