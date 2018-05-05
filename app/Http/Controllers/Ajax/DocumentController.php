<?php

namespace App\Http\Controllers\Ajax;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookmarkRepositoryInterface;

class DocumentController extends Controller
{
    protected $bookmarkRepository;

    public function __construct(
        BookmarkRepositoryInterface  $bookmarkRepository
    ) {
        $this->bookmarkRepository = $bookmarkRepository;
    }

    public function bookmark(Request $request) {
        if ($request->ajax()) {
            $bookmark['user_id'] = Auth::user()->id;
            $bookmark['document_id'] = $request->documentId;
            $this->bookmarkRepository->create($bookmark);

            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }

    public function cancelBookmark(Request $request)
    {
        if ($request->ajax()) {
            $userId = Auth::user()->id;
            $documentId = $request->documentId;
            $this->bookmarkRepository->where('user_id', $userId)->where('document_id', $documentId)->delete();

            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }

    public function comment() {

    }
}
