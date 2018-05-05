<?php

namespace App\Http\Controllers\User;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class UploadedController extends Controller
{
    protected $documentRepository;
    
    public function __construct(
        DocumentRepositoryInterface $documentRepository
    ) {
        $this->documentRepository = $documentRepository;
    }

    public function index()
    {
        $user = Auth::user();
        $documents = $this->documentRepository->getUploadedDocument(Auth::user()->id);

        return view('user.pages.uploaded', compact('documents', 'user'));
    }
}
