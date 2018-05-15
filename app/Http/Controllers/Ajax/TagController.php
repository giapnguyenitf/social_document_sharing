<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TagRepositoryInterface;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(
        TagRepositoryInterface $tagRepository
    ) {
        $this->tagRepository = $tagRepository;
    }

    public function getAllTag()
    {
        $tags = $this->tagRepository->pluck('name')->all();

        return response()->json($tags);
    }
}
