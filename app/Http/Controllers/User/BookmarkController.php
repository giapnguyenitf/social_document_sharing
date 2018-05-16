<?php

namespace App\Http\Controllers\User;

use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookmarkRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;


class BookmarkController extends Controller
{
    protected $bookmarkRepository;
    protected $documentRepository;
    protected $categoryRepository;

    public function __construct(
        DocumentRepositoryInterface $documentRepository,
        BookmarkRepositoryInterface  $bookmarkRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->bookmarkRepository = $bookmarkRepository;
        $this->documentRepository = $documentRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        try {
            $user = Auth::user();
            $bookmarks = $this->bookmarkRepository->getByUser($user->id);
            $categories = $this->categoryRepository->getAll();

            return view('user.pages.bookmark', compact('bookmarks', 'categories'));
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
