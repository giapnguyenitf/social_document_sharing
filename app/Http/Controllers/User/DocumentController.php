<?php

namespace App\Http\Controllers\User;

use Auth;
// use Exception;
use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadDocumentRequest;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class DocumentController extends Controller
{
    use UploadFileTrait;

    protected $categoryRepository;
    protected $documentRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        DocumentRepositoryInterface $documentRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->documentRepository = $documentRepository;
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
        $document = $this->documentRepository->find($id);
        $relatedDocuments = $this->documentRepository->where('category_id', '=',$document->category_id)->with('user')->get()->take(10);

        return view('user.pages.view-document', compact('document', 'relatedDocuments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = $this->documentRepository->find($id);

        return view('user.pages.edit-document', compact('document'));
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
            $this->documentRepository->delete($id);

            return back();
        } catch(Exception $e) {
            return back();
        }
    }
}
