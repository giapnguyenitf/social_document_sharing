<?php

namespace App\Http\Controllers\User;

use App;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\NotificationRepositoryInterface;

class HomeController extends Controller
{
    protected $categoryRepository;
    protected $documentRepository;
    protected $notificationRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        DocumentRepositoryInterface $documentRepository,
        NotificationRepositoryInterface $notificationRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->documentRepository = $documentRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function index()
    {
        $newestDocuments = $this->documentRepository->getNewests();
        $allDocuments = $this->documentRepository->getAll();
        $topViewsDocuments = $this->documentRepository->getTopViews();
        $numberDocument = $this->documentRepository->countAll();
        $numberCategory = $this->categoryRepository->countAll();
        $numberViews = $this->documentRepository->allViews();
        $categories = $this->categoryRepository->getAll();
        $notifications = [];

        if (auth()->check()) {
            $notifications = $this->notificationRepository->getAll(auth()->user()->id);
        }

        return view('user.pages.home', compact(
            'newestDocuments',
            'allDocuments',
            'topViewsDocuments',
            'numberDocument',
            'numberCategory',
            'numberViews',
            'categories',
            'notifications'
        ));
    }

    public function setLocale($locale)
    {
        Session::put('locale', $locale);

        return back();
    }
}
