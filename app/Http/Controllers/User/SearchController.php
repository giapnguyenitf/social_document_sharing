<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\NotificationRepositoryInterface;

class SearchController extends Controller
{
    protected $documentRepository;
    protected $categoryRepository;
    protected $tagRepository;
    protected $notificationRepository;

    public function __construct(
        TagRepositoryInterface $tagRepository,
        DocumentRepositoryInterface $documentRepository,
        CategoryRepositoryInterface $categoryRepository,
        NotificationRepositoryInterface $notificationRepository
    ) {
        $this->documentRepository = $documentRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function search(Request $request)
    {
        $newestDocuments = $this->documentRepository->getNewests();
        $keyword = $request->keyword;
        $category = $request->category;
        $categories = $this->categoryRepository->getAll();
        $notifications = [];

        if (auth()->check()) {
            $notifications = $this->notificationRepository->getAll(auth()->user()->id);
        }

        if ($category == config('settings.search.by_all')) {
            $documents = $this->documentRepository->searchByName($keyword);
        } else {
            $searchBy = $this->categoryRepository->where('slug', $category)->firstOrFail();
            $documents = $this->documentRepository->searchByCategory($keyword, $searchBy->id);
        }

        return view('user.pages.search', compact('documents', 'keyword', 'newestDocuments', 'categories', 'notifications'));
    }

    public function showBySubCategory($slug)
    {
        $category = $this->categoryRepository->where('slug', $slug)->firstOrFail();
        $documents = $this->documentRepository->getBySubCategory($category->id);
        $newestDocuments = $this->documentRepository->getNewests();
        $categories = $this->categoryRepository->getAll();
        $notifications = [];

        if (auth()->check()) {
            $notifications = $this->notificationRepository->getAll(auth()->user()->id);
        }

        return view('user.pages.show-by-category', compact('documents', 'category', 'newestDocuments', 'categories', 'notifications'));
    }

    public function showByParentCategory($categoryId)
    {
        $documents = $this->documentRepository->getByParentCategory($categoryId);
        $category = $this->categoryRepository->find($categoryId);
        $newestDocuments = $this->documentRepository->getNewests();
        $categories = $this->categoryRepository->getAll();
        $notifications = [];

        if (auth()->check()) {
            $notifications = $this->notificationRepository->getAll(auth()->user()->id);
        }

        return view('user.pages.show-by-category', compact('documents', 'category', 'newestDocuments', 'categories', 'notifications'));
    }

    public function showByTag($slug)
    {
        $tag = $this->tagRepository->getDocumentBytag($slug);
        $newestDocuments = $this->documentRepository->getNewests();
        $categories = $this->categoryRepository->getAll();
        $notifications = [];

        if (auth()->check()) {
            $notifications = $this->notificationRepository->getAll(auth()->user()->id);
        }

        return view('user.pages.show-by-tag', compact('tag', 'newestDocuments', 'categories', 'notifications'));
    }
}
