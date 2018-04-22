<?php

namespace App\Repositories\Eloquent;

use App\Models\Document;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class DocumentRepository extends BaseRepository implements DocumentRepositoryInterface
{
    public function getModel()
    {
        return Document::class;
    }

    public function getUploadedDocument($userID)
    {
        return $this->model->where('user_id', $userID)->paginate(config('settings.document.uploaded.paginate'));
    }
}
