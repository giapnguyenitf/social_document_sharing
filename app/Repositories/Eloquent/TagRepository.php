<?php

namespace App\Repositories\Eloquent;

use App\Models\Tag;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function getModel()
    {
        return Tag::class;
    }

    public function getDocumentBytag($slug)
    {
        return $this->model->with(['documents' => function($query) {
            $query->paginate(config('settings.document.paginate_per_page'));
        }])
        ->where('slug', $slug)
        ->first();
    }
}
