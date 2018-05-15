<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class SearchController extends Controller
{
    protected $documentRepository;
    protected $categoryRepository;

    public function __construct(
        DocumentRepositoryInterface $documentRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->documentRepository = $documentRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $keyword = $request->keyword;
            $category = $request->category;

            if ($category == config('settings.search.by_all')) {
                $results = Document::search($keyword)->take(6)->get();
            } else {
                $searchBy = $this->categoryRepository->where('slug', $category)->firstOrFail();
                $results = $this->documentRepository->searchByCategory($keyword, $searchBy->id)->take(5);
            }

            return response()->json([
                'status' => true,
                'data' => $results,
                'url' => route('view-document', ''),
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }
}
