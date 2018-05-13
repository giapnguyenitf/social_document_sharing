<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
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
        $newestDocuments = $this->documentRepository->getNewests();
        $keyword = $request->keyword;
        $category = $request->category;

        if ($category == config('settings.search.by_all')) {
            $documents = $this->documentRepository->searchByName($keyword);
        } else {
            $searchBy = $this->categoryRepository->where('slug', $category)->firstOrFail();
            $documents = $this->documentRepository->searchByCategory($keyword, $searchBy->id);
        }

        return view('user.pages.search', compact('documents', 'keyword', 'newestDocuments'));
    }

    public function showBySubCategory($slug)
    {
        $category = $this->categoryRepository->where('slug', $slug)->firstOrFail();
        $documents = $this->documentRepository->getBySubCategory($category->id);
        $newestDocuments = $this->documentRepository->getNewests();

        return view('user.pages.category', compact('documents', 'category', 'newestDocuments'));
    }

    public function showByParentCategory($categoryId)
    {
        $documents = $this->documentRepository->getByParentCategory($categoryId);
        $category = $this->categoryRepository->find($categoryId);
        $newestDocuments = $this->documentRepository->getNewests();

        return view('user.pages.category', compact('documents', 'category', 'newestDocuments'));
    }
}
