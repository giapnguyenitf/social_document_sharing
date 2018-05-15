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

    public function getDocument($slug);

    public function getPublished();

    public function getChecking();

    public function getIllegal();

    public function getRelatedCategory($id, $categoryId);

    public function countDocumentByAuthor($userId);
}
