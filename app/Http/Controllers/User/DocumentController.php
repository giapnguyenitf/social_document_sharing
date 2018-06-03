<?php

namespace App\Http\Controllers\User;

use Auth;
use Storage;
use Session;
use Exception;
use App\Events\DocumentEvent;
use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDocumentRequest;
use App\Http\Requests\UploadDocumentRequest;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Contracts\BookmarkRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\NotificationRepositoryInterface;

class DocumentController extends Controller
{
    use UploadFileTrait;

    protected $tagRepository;
    protected $userRepository;
    protected $commentRepository;
    protected $categoryRepository;
    protected $documentRepository;
    protected $bookmarkRepository;
    protected $notificationRepository;

    public function __construct(
        TagRepositoryInterface $tagRepository,
        UserRepositoryInterface $userRepository,
        CommentRepositoryInterface $commentRepository,
        CategoryRepositoryInterface $categoryRepository,
        DocumentRepositoryInterface $documentRepository,
        BookmarkRepositoryInterface  $bookmarkRepository,
        NotificationRepositoryInterface $notificationRepository
    ) {
        $this->tagRepository = $tagRepository;
        $this->userRepository = $userRepository;
        $this->commentRepository = $commentRepository;
        $this->categoryRepository = $categoryRepository;
        $this->documentRepository = $documentRepository;
        $this->bookmarkRepository = $bookmarkRepository;
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentCategories = $this->categoryRepository->where('parent_id', '=', config('settings.category.is_parent'))->get();
        $categories = $this->categoryRepository->getAll();
        $notifications = $this->notificationRepository->getAll(auth()->user()->id);

        return view('user.pages.upload', compact('parentCategories', 'categories', 'notifications', 'notifications'));
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
            // store document
            $document = $request->only([
                'name',
                'description',
                'thumbnail',
            ]);
            $file = $request->file('document');
            $filePath = $this->uploadFile(config('settings.document.path_store'), $file);
            $document['file_name'] = $filePath;
            $document['file_size'] = round($file->getClientSize()/(1024*1024), 2);
            $document['file_type'] = $file->extension();
            $document['category_id'] = $request->has('child_category') ? $request->child_category : $request->parent_category;
            $document['user_id'] = Auth::user()->id;
            $document = $this->documentRepository->create($document);

            // create tags for document
            if ($request->tag) {
                $documentTags = explode(',', $request->tag);
                $tagExists = $this->tagRepository->pluck('name')->all();
                $newTags = array_diff($documentTags, $tagExists);

                foreach ($newTags as $value) {
                    $this->tagRepository->create(['name' => $value]);
                }

                $documentTagIds = $this->tagRepository->whereIn('name', $documentTags)->pluck('id')->all();
                $document->tags()->attach($documentTagIds);
            }

            $notification = $this->notificationRepository->create([
                'user_id' => auth()->user()->id,
                'message' => trans('user.notification_upload_success', ['document' => $document->name]),
                'status' => config('settings.notification.status.unread'),
            ]);
            event(new DocumentEvent($document->user_id, trans('user.notification_upload_success', ['document' => $document->name]), $notification->created_at->toDateTimeString()));

            return redirect()->route('uploaded-document.show')->with('messageSuccess', trans('user.document.upload_success'));
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
            $categories = $this->categoryRepository->getAll();
            $document = $this->documentRepository->getDocument($slug);
            $comments = $this->commentRepository->getComment($slug);
            $relatedDocuments = $this->documentRepository->getRelatedCategory($document->id, $document->category_id);
            $authorUploaded = $this->documentRepository->countDocumentByAuthor($document->user->id);
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
                $notifications = $this->notificationRepository->getAll($user->id);

                if ( $user->can('view', $document)) {
                    return view('user.pages.view-document', compact(
                        'document',
                        'urlViewer',
                        'relatedDocuments',
                        'authorUploaded',
                        'isBookmark',
                        'comments',
                        'categories',
                        'notifications'
                        )
                    );
                }

                return view('errors.403');
            } else if ($document->isPublished()){
                return view('user.pages.view-document', compact(
                    'document',
                    'urlViewer',
                    'relatedDocuments',
                    'authorUploaded',
                    'isBookmark',
                    'comments',
                    'categories'
                    )
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
            $categories = $this->categoryRepository->getAll();
            $document = $this->documentRepository->where('slug', $slug)->firstOrFail();
            $user = Auth::user();
            $notifications = $this->notificationRepository->getAll($user->id);

            if ($user->can('edit', $document)) {
                $parentCategories = $this->categoryRepository->where('parent_id', '=', config('settings.category.is_parent'))->get();

                return view('user.pages.edit-document', compact('document', 'parentCategories', 'categories', 'notifications'));
            }

            return view('errors.403');
        } catch(Exception $e) {
            return view('errors.404');
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
                    'thumbnail',
                ]);

                if ($request->parent_category == config('settings.category.category_default')) {
                    $document['category_id'] = $request->parent_category;
                } else if ($request->child_category) {
                    $document['category_id'] =  $request->child_category;
                }

                $this->documentRepository->where('id', $oldDocument->id)->update($document);

                 // create tags for document
                if ($request->tag) {
                    $documentTags = explode(',', $request->tag);
                    $tagExists = $this->tagRepository->pluck('name')->all();
                    $newTags = array_diff($documentTags, $tagExists);

                    foreach ($newTags as $value) {
                        $this->tagRepository->create(['name' => $value]);
                    }

                    $documentTagIds = $this->tagRepository->whereIn('name', $documentTags)->pluck('id')->all();
                    $oldDocument->tags()->detach();
                    $oldDocument->tags()->attach($documentTagIds);
                }

                return redirect()->route('uploaded-document.show')->with('messageSuccess', trans('user.document.update_success'));
            } else {
                return view('errors.403');
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

                if (Session::has('recently_download')) {
                    $recentlyDownload = Session::get('recently_download');
                    if (!in_array($document->id, $recentlyDownload)) {
                        $downloads = $document->downloads + 1;
                        $this->documentRepository->where('id', $document->id)->update(['downloads' => $downloads]);
                        Session::push('recently_download', $document->id);
                    }
                } else {
                    $downloads = $document->downloads + 1;
                    $this->documentRepository->where('id', $document->id)->update(['downloads' => $downloads]);
                    Session::push('recently_download', $document->id);
                }


                if (Auth::check()) {
                    $downloadedDocument = Auth::user()->downloaded;
                    $downloadedDocument = explode(',', $downloadedDocument);

                    if (!in_array($document->id, $downloadedDocument)) {
                        array_push($downloadedDocument, $document->id);
                    }

                    $downloadedDocument = implode(',', $downloadedDocument);
                    $this->userRepository->where('id', Auth::user()->id)->update(['downloaded' => $downloadedDocument]);
                }

                return response()->download($document->download_link, $document->slug . '.pdf');
            } else {
                return view('errors.404');
            }
        } catch(Exception $e) {
            return view('errors.404');
        }
    }
}
