<?php

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\RepositoryInterface;

interface DocumentRepositoryInterface extends RepositoryInterface
{
    public function getUploadedDocument($userId);

    public function getNewests();

    public function getTopViews();

    public function getAll();

    public function countAll();

    public function allViews();

    public function searchByName($keyword);

    public function searchByCategory($keyword, $categoryId);

    public function getBySubCategory($categoryId);

    public function getByParentCategory($categoryId);

    public function getDocument($id);

    public function getPublished();

    public function getChecking();

    public function getIllegal();
}
