<?php

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\RepositoryInterface;

interface TagRepositoryInterface extends RepositoryInterface
{
    public function getDocumentBytag($slug);
}
