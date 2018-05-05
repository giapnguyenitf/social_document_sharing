<?php

namespace App\Http\Controllers\User;

use Auth;
use Storage;
use Session;
use Exception;
use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadDocumentRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\BookmarkRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;


class DocumentController extends Controller
{
    use UploadFileTrait;

    protected $userRepository;
    protected $categoryRepository;
    protected $documentRepository;
    protected $bookmarkRepository;
    protected $commentRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        CategoryRepositoryInterface $categoryRepository,
        DocumentRepositoryInterface $documentRepository,
        BookmarkRepositoryInterface  $bookmarkRepository,
        CommentRepositoryInterface $commentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->documentRepository = $documentRepository;
        $this->bookmarkRepository = $bookmarkRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $parentCategories = $this->categoryRepository->where('parent_id', '=', config('settings.category.is_parent'))->get();

        return view('user.pages.upload', compact('user', 'parentCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadDocumentRequest $request)
    {
        try {
            $document = $request->only([
                'name',
                'description',
                'tag',
            ]);

            $file = $request->file('document');
            $thumbnail = $request->file('thumbnail');
            $filePath = $this->uploadFile(config('settings.document.path_store'), $file);
            $thumbnailPath = $this->uploadFile(config('settings.document.path_thumbnail'), $thumbnail);
            
            $document['file_name'] = $filePath;
            $document['file_size'] = round($file->getClientSize()/(1024*1024), 2);
            $document['file_type'] = $file->extension();
            $document['category_id'] = $request->input('child_category');
            $document['thumbnail'] = $thumbnailPath;
            $document['user_id'] = Auth::user()->id;
            $this->documentRepository->create($document);

            return back()->with('messageSuccess', trans('user.document.upload_success'));
        } catch(Exception $e) {
            return back()->with('messageError', trans('user.document.upload_fail'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $document = $this->documentRepository->getDocument($id);
            $comments = $this->commentRepository->getComment($id);
            
            if (Session::has('recently_view')) {
                $recentlyView = Session::get('recently_view');
                if (!in_array($id, $recentlyView)) {
                    $views = $document->views + 1;
                    $this->documentRepository->update($id, ['views' => $views]);
                    Session::push('recently_view', $document->id);
                } 
            } else {
                $views = $document->views + 1;
                $this->documentRepository->update($id, ['views' => $views]);
                Session::push('recently_view', $document->id);
            }

            $relatedDocuments = $this->documentRepository->where('category_id', $document->category_id)
                ->where('id', '!=', $document->id)
                ->with('user')->get()->take(10);
            $authorUploaded = $this->documentRepository->where('status',config('settings.document.status.is_published'))
                ->where('user_id', $document->user->id)->count();

            if (Auth::check()) {
                $isBookmark = $this->bookmarkRepository->isBookmark(Auth::user()->id, $id);
            } else {
                $isBookmark = config('settings.document.is_bookmark.false');
            }

            return view('user.pages.view-document', compact('document', 'relatedDocuments', 'authorUploaded', 'isBookmark', 'comments'));
        } catch(Exception $e) {
            return back()->with('messageError', trans('user.document.document_not_found'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $document = $this->documentRepository->findOrFail($id);

            if ($document->user_id == Auth::user()->id) {
                return view('user.pages.edit-document', compact('document'));
            }

            return back();
        } catch(Excepion $e) {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $document = $this->documentRepository->findOrFail($id);

            if ($document->user_id == Auth::user()->id) {
                $this->documentRepository->delete($id);

                return back()->with('messageSuccess', trans('user.document.delete_success'));
            }

            return back()->with('messagesError', trans('user.document.delete_fail'));
        } catch(Exception $e) {
            return back()->with('messagesError', trans('user.document.delete_fail'));
        }
    }

    public function download($id)
    {
        try {
            $document = $this->documentRepository->find($id);
            $fileName = $document->file_name;
            $filePath = str_replace('storage', '', $fileName);
            $exist = Storage::disk('public')->exists($filePath);

            if ($exist) {
                $downloads = $document->downloads + 1;
                $this->documentRepository->update($id, ['downloads' => $downloads]);

                if (Auth::check()) {
                    $downloadedDocument = Auth::user()->downloaded;
                    $downloadedDocument = explode(',', $downloadedDocument);
                    
                    if (!in_array($id, $downloadedDocument)) {
                        array_push($downloadedDocument, $id);
                    }

                    $downloadedDocument = implode(',', $downloadedDocument);
                    $this->userRepository->update(Auth::user()->id, ['downloaded' => $downloadedDocument]);
                }

                return response()->download($document->download_link);
            } else {
                return back();
            }
        } catch(Exception $e) {
            return back();
        }
    }

    public function showDownloaded()
    {
        try {
            $user = Auth::user();
            $downloadedDocument = explode(',', $user->downloaded);
            $downloadedDocuments = $this->documentRepository->withTrashed()->whereIn('id', $downloadedDocument)
                ->paginate(config('settings.document.downloaded.paginate'));

            return view('user.pages.downloaded', compact('downloadedDocuments'));
        } catch(Exception $e) {
            return back();
        }
    }
}
