<?php

namespace App\Http\Controllers\User;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class SearchController extends Controller
{
    protected $documentRepository;
    protected $categoryRepository;
    protected $tagRepository;

    public function __construct(
        TagRepositoryInterface $tagRepository,
        DocumentRepositoryInterface $documentRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->documentRepository = $documentRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function search(Request $request)
    {
        $newestDocuments = $this->documentRepository->getNewests();
        $keyword = $request->keyword;
        $category = $request->category;
        $categories = $this->categoryRepository->getAll();

        if ($category == config('settings.search.by_all')) {
            $documents = Document::search($keyword)->paginate(config('settings.document.paginate_per_page'));
        } else {
            $searchBy = $this->categoryRepository->where('slug', $category)->firstOrFail();
            $documents = $this->documentRepository->searchByCategory($keyword, $searchBy->id);
        }

        return view('user.pages.search', compact('documents', 'keyword', 'newestDocuments', 'categories'));
    }

    public function showBySubCategory($slug)
    {
        $category = $this->categoryRepository->where('slug', $slug)->firstOrFail();
        $documents = $this->documentRepository->getBySubCategory($category->id);
        $newestDocuments = $this->documentRepository->getNewests();
        $categories = $this->categoryRepository->getAll();

        return view('user.pages.show-by-category', compact('documents', 'category', 'newestDocuments', 'categories'));
    }

    public function showByParentCategory($categoryId)
    {
        $documents = $this->documentRepository->getByParentCategory($categoryId);
        $category = $this->categoryRepository->find($categoryId);
        $newestDocuments = $this->documentRepository->getNewests();
        $categories = $this->categoryRepository->getAll();

        return view('user.pages.show-by-category', compact('documents', 'category', 'newestDocuments', 'categories'));
    }

    public function showByTag($slug)
    {
        $tag = $this->tagRepository->getDocumentBytag($slug);
        $newestDocuments = $this->documentRepository->getNewests();
        $categories = $this->categoryRepository->getAll();

        return view('user.pages.show-by-tag', compact('tag', 'newestDocuments', 'categories'));
    }
}
