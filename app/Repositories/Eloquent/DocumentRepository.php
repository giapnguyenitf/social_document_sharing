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
}
