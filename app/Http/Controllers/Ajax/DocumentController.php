<?php

namespace App\Http\Controllers\Ajax;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookmarkRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class DocumentController extends Controller
{
    protected $bookmarkRepository;
    protected $commentRepository;
    protected $documentRepository;

    public function __construct(
        BookmarkRepositoryInterface  $bookmarkRepository,
        CommentRepositoryInterface $commentRepository,
        DocumentRepositoryInterface $documentRepository
    ) {
        $this->bookmarkRepository = $bookmarkRepository;
        $this->commentRepository = $commentRepository;
        $this->documentRepository = $documentRepository;
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

    public function comment(Request $request) {
        if ($request->ajax() && Auth::check()) {
            $comment['user_id'] = Auth::user()->id;
            $comment['document_id'] = $request->document_id;
            $comment['messages'] = $request->messages;
            $comment = $this->commentRepository->create($comment);
            $comment = $this->commentRepository->with('user')->find($comment->id);
            
            if ($comment) {
                return response()->json([
                    'success' => true,
                    'comment' => $comment,
                ]);
            }

            return response()->json([
                'success' => false,
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }

    public function countNewDocuments(Request $request)
    {
        if ($request->ajax()) {
            $newDocument = $this->documentRepository->getChecking()->count();

            return response()->json([
                'success' => true,
                'data' => $newDocument,
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }
}
