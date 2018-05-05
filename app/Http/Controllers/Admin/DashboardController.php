<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class DashboardController extends Controller
{
    protected $userRepository;
    protected $documentRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        DocumentRepositoryInterface $documentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->documentRepository = $documentRepository;
    }

    public function index()
    {
        $numberNewDocuments = $this->documentRepository->where('status', config('settings.document.status.is_checking'))->count();
        $numberUsers = $this->userRepository->where('rules', config('settings.rules.is_user'))->count();
        $views = $this->documentRepository->where('status', config('settings.document.status.is_published'))->sum('views');
        $downloads = $this->documentRepository->where('status', config('settings.document.status.is_published'))->sum('downloads');

        return view('admin.pages.index', compact('numberNewDocuments', 'numberUsers', 'views', 'downloads'));
    }
}
