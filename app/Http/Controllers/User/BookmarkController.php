<?php

namespace App\Http\Controllers\User;

use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookmarkRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class BookmarkController extends Controller
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

    public function delete($id)
    {
        try {
            $user = Auth::user();
            $bookmark = $this->bookmarkRepository->find($id);

            if ($user->can('delete', $bookmark)) {
                $this->bookmarkRepository->destroy($id);

                return back()->with('messageSuccess', trans('user.document.delete_bookmark_success'));
            }

            return back()->with('messageError', trans('user.document.you_are_not_allowed_to_delete_this_bookmark'));
        } catch(Exception $e) {
            return back()->with('messageError', trans('user.document.document_not_found'));
        }

    }
}
