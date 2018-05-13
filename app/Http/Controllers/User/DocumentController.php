<?php

namespace App\Http\Controllers\User;

use Auth;
use Storage;
use Session;
// use Exception;
use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDocumentRequest;
use App\Http\Requests\UploadDocumentRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Contracts\BookmarkRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;


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
        $parentCategories = $this->categoryRepository->where('parent_id', '=', config('settings.category.is_parent'))->get();

        return view('user.pages.upload', compact('parentCategories'));
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
                'thumbnail',
            ]);

            $file = $request->file('document');
            $filePath = $this->uploadFile(config('settings.document.path_store'), $file);
            $document['file_name'] = $filePath;
            $document['file_size'] = round($file->getClientSize()/(1024*1024), 2);
            $document['file_type'] = $file->extension();
            $document['category_id'] = $request->input('child_category');
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
    public function show($slug)
    {
        try {
            $document = $this->documentRepository->getDocument($slug);
            $comments = $this->commentRepository->getComment($slug);
            $relatedDocuments = $this->documentRepository->getRelatedCategory($document->id, $document->category_id);
            $authorUploaded = $this->documentRepository->where('status',config('settings.document.status.is_published'))
                ->where('user_id', $document->user->id)->count();
            $isBookmark = config('settings.document.is_bookmark.false');
            $urlViewer = route('viewer') . '?file=' . $document->file_name;

            if (Session::has('recently_view')) {
                $recentlyView = Session::get('recently_view');
                if (!in_array($document->id, $recentlyView)) {
                    $views = $document->views + 1;
                    $this->documentRepository->where('id', $document->id)->update(['views' => $views]);
                    Session::push('recently_view', $document->id);
                }
            } else {
                $views = $document->views + 1;
                $this->documentRepository->where('id', $document->id)->update(['views' => $views]);
                Session::push('recently_view', $document->id);
            }

            if (Auth::check()) {
                $user = Auth::user();
                $isBookmark = $this->bookmarkRepository->isBookmark($user->id, $document->id);

                if ( $user->can('view', $document)) {
                    return view('user.pages.view-document', compact(
                        'document',
                        'urlViewer',
                        'relatedDocuments',
                        'authorUploaded',
                        'isBookmark',
                        'comments')
                    );
                }

                return back()->with('messageError', trans('user.document.document_not_found'));
            } else if ($document->isPublished()){
                return view('user.pages.view-document', compact(
                    'document',
                    'urlViewer',
                    'relatedDocuments',
                    'authorUploaded',
                    'isBookmark',
                    'comments')
                );
            }

            return back()->with('messageError', trans('user.document.document_not_found'));
        } catch(Exception $e) {
            return view('errors.404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        try {
            $document = $this->documentRepository->where('slug', $slug)->firstOrFail();
            $user = Auth::user();

            if ($user->can('edit', $document)) {
                $parentCategories = $this->categoryRepository->where('parent_id', '=', config('settings.category.is_parent'))->get();

                return view('user.pages.edit-document', compact('document', 'parentCategories'));
            }

            return back()->with('messageError', trans('user.document.you_are_not_allowed_to_edit_this_document'));
        } catch(Exception $e) {
            return back()->with('messageError', trans('user.document.document_not_found'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentRequest $request, $slug)
    {
        try {
            $oldDocument = $this->documentRepository->where('slug', $slug)->firstOrFail();
            $user = Auth::user();

            if ($user->can('update', $oldDocument)) {
                $document = $request->only([
                    'name',
                    'description',
                ]);
                $document['category_id'] = $request->child_category;
                $document['tag'] = $request->tag ? $request->tag : ' ';

                if ($request->thumbnail) {
                    $document['thumbnail'] = $request->thumbnail;
                }

                $this->documentRepository->where('id', $oldDocument->id)->update($document);

                return redirect()->route('uploaded-document.show')->with('messageSuccess', trans('user.document.update_success'));
            } else {
                return back()->with('messageError', trans('user.document.you_are_not_allowed_to_edit_this_document'));
            }
        } catch(Exception $e) {
            return back()->with('messageError', trans('user.document.update_fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        try {
            $user = Auth::user();
            $document = $this->documentRepository->where('slug', $slug)->firstOrFail();

            if ($user->can('delete', $document)) {
                $document->delete();

                return back()->with('messageSuccess', trans('user.document.delete_success'));
            } else {
                return back()->with('messageError', trans('user.document.you_are_not_allowed_to_delete_this_document'));
            }
        } catch(Exception $e) {
            return back()->with('messageError', trans('user.document.document_not_found'));
        }
    }

    public function download($slug)
    {
        try {
            $document = $this->documentRepository->where('slug', $slug)->firstOrFail();
            $fileName = $document->file_name;
            $filePath = str_replace('storage', '', $fileName);
            $exist = Storage::disk('public')->exists($filePath);

            if ($exist) {
                $downloads = $document->downloads + 1;
                $this->documentRepository->where('id', $document->id)->update(['downloads' => $downloads]);

                if (Auth::check()) {
                    $downloadedDocument = Auth::user()->downloaded;
                    $downloadedDocument = explode(',', $downloadedDocument);

                    if (!in_array($document->id, $downloadedDocument)) {
                        array_push($downloadedDocument, $document->id);
                    }

                    $downloadedDocument = implode(',', $downloadedDocument);
                    $this->userRepository->where('id', Auth::user()->id)->update(['downloaded' => $downloadedDocument]);
                }

                return response()->download($document->download_link);
            } else {
                return view('errors.404');
            }
        } catch(Exception $e) {
            return view('errors.404');
        }
    }
}
