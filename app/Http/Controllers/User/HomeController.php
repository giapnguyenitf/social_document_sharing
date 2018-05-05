<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class HomeController extends Controller
{
    protected $categoryRepository;
    protected $documentRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        DocumentRepositoryInterface $documentRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->documentRepository = $documentRepository;
    }

    public function index()
    {
        $newestDocuments = $this->documentRepository->getNewests();
        $allDocuments = $this->documentRepository->getAll();
        $topViewsDocuments = $this->documentRepository->getTopViews();
        $numberDocument = $this->documentRepository->countAll();
        $numberCategory = $this->categoryRepository->countAll();
        $numberViews = $this->documentRepository->allViews();

        return view('user.pages.home', compact(
            'newestDocuments',
            'allDocuments',
            'topViewsDocuments',
            'numberDocument',
            'numberCategory',
            'numberViews'
        ));
    }
}
