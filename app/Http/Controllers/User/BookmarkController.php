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
            $user = Auth::user();
            $bookmarks = $this->bookmarkRepository->getByUser($user->id);

            return view('user.pages.bookmark', compact('bookmarks'));
        } catch(Exception $e) {
            return back();
        }
    }

    public function delete($id)
    {
        try {
            $user = Auth::user();
            $bookmark = $this->bookmarkRepository->findOrFail($id);

            if ($user->can('delete', $bookmark)) {
                $this->bookmarkRepository->destroy($id);

                return back()->with('messageSuccess', trans('user.document.delete_bookmark_success'));
            }

            return view('errors.403');
        } catch(Exception $e) {
            return back()->with('messageError', trans('user.document.document_not_found'));
        }

    }
}
