<?php

namespace App\Http\Controllers\User;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookmarkRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class BookmarkDocumentController extends Controller
{
    protected $bookmarkRepository;
    protected $documentRepository;

    public function __construct(
        DocumentRepositoryInterface $documentRepository,
        BookmarkRepositoryInterface  $bookmarkRepository
    ) {
        $this->bookmarkRepository = $bookmarkRepository;
        $this->documentRepository = $documentRepository;
    }

    public function index()
    {
       try {
            $userId = Auth::user()->id;
            $bookmarkDocuments = $this->bookmarkRepository->getByUser($userId);

            return view('user.pages.bookmark', compact('bookmarkDocuments'));
       } catch(Exception $e) {
           return back();
       }
    }

    public function delete($documentId)
    {
        try {
            $userId = Auth::user()->id;
            $this->bookmarkRepository->where('user_id', $userId)->where('document_id', $documentId)->delete();

            return back()->with('messageSuccess', trans('user.document.delete_bookmark_success'));
        } catch(Exception $e) {
            return back()->with('messageError', trans('user.document.delete_bookmark_fail'));
        }

    }
}
