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

    public function getNewests()
    {
        return $this->model->where('status', config('settings.document.status.is_published'))
            ->orderBy('created_at', 'desc')
            ->take(config('settings.document.top_new'))
            ->get();
    }

    public function getTopViews()
    {
        return $this->model->where('status', config('settings.document.status.is_published'))
            ->orderBy('views', 'asc')
            ->take(config('settings.document.top_views'))
            ->get();
    }

    public function getAll()
    {
        return $this->model->where('status', config('settings.document.status.is_published'))
            ->orderBy('created_at', 'desc')
            ->paginate(config('settings.document.paginate_per_page'));
    }

    public function countAll()
    {
        return $this->model->where('status', config('settings.document.status.is_published'))->count();
    }

    public function allViews()
    {
        return $this->model->where('status', config('settings.document.status.is_published'))->sum('views');
    }

    public function searchByName($keyword)
    {
        return $this->model->where('status', config('settings.document.status.is_published'))
            ->where('name', 'like', '%' . $keyword . '%')
            ->with('user', 'category')
            ->paginate(config('settings.document.paginate_per_page'));
    }

    public function searchByCategory($keyword, $categoryId)
    {
        return $this->model->where('status', config('settings.document.status.is_published'))
            ->whereIn('category_id', function ($query) use ($categoryId) {
                $query->select('id')->from('categories')->where('parent_id', $categoryId);
            })
            ->where('name', 'like', '%' . $keyword . '%')
            ->paginate(config('settings.document.paginate_per_page'));
    }
}
