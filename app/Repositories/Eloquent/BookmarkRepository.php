<?php

namespace App\Repositories\Eloquent;

use App\Models\Bookmark;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\BookmarkRepositoryInterface;

class BookmarkRepository extends BaseRepository implements BookmarkRepositoryInterface
{
    public function getModel()
    {
        return Bookmark::class;
    }

    public function isBookmark($userId, $documentId)
    {
        return $this->model->where('user_id', $userId)->where('document_id', $documentId)->exists();
    }

    public function getByUser($userId)
    {
        return $this->model->where('user_id', $userId)
            ->with('document')
            ->get();
    }
}
