<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getAll()
    {
        return $this->model->where('parent_id', '=', config('settings.category.is_parent'))
            ->with('subCategories')
            ->orderBy('name', 'asc')
            ->get();
    }

    public function countAll()
    {
        return $this->model->count();
    }
}
