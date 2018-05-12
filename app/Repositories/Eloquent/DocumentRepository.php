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

    public function getUploadedDocument($userId)
    {
        return $this->model->where('user_id', $userId)->paginate(config('settings.document.uploaded.paginate'));
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
            ->orderBy('views', 'desc')
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

    public function getBySubCategory($categoryId)
    {
        return $this->model->where('category_id', $categoryId)
            ->where('status', config('settings.document.status.is_published'))
            ->paginate(config('settings.document.paginate_per_page'));
    }

    public function getByParentCategory($categoryId)
    {
        return $this->model->where('status', config('settings.document.status.is_published'))
            ->whereIn('category_id', function($query) use ($categoryId) {
                $query->select('id')->from('categories')->where('parent_id', $categoryId);
            })
            ->paginate(config('settings.document.paginate_per_page'));
    }

    public function getDocument($id)
    {
        return $this->model->with('user')->findOrFail($id);
    }

    public function getPublished()
    {
        return $this->model->where('status', config('settings.document.status.is_published'))
            ->with(['user', 'category'])
            ->get();
    }

    public function getChecking()
    {
        return $this->model->where('status', config('settings.document.status.is_checking'))
            ->with(['user', 'category'])
            ->get();
    }

    public function getIllegal()
    {
        return $this->model->where('status', config('settings.document.status.is_illegal'))
            ->with(['user', 'category'])
            ->get();
    }

    public function getRelatedCategory($id, $categoryId)
    {
        return $this->model->where('category_id', $categoryId)
                ->where('status',config('settings.document.status.is_published'))
                ->where('id', '!=', $id)
                ->with('user')
                ->take(config('settings.top_related_document'))
                ->get();
    }
}
