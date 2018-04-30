<?php

namespace App\Http\Controllers\User;

use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDocumentRequest;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class UploadedDocumentController extends Controller
{
    protected $documentRepository;
    protected $categoryRepository;
    
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        DocumentRepositoryInterface $documentRepository
    ) {
        $this->documentRepository = $documentRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $documents = $this->documentRepository->getUploadedDocument(Auth::user()->id);

        return view('user.pages.uploaded', compact('documents', 'user'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $parentCategories = $this->categoryRepository->where('parent_id', '=', config('settings.category.is_parent'))->get();

        return view('user.pages.edit-document', compact('document', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentRequest $request, $id)
    {
        try {
            $document = $request->only([
                'name',
                'description',
            ]);
            $document['category_id'] = $request->child_category;
            $document['tag'] = $request->tag ? $request->tag : ' ';

            if ($request->thumbnail) {
                $document['thumbnail'] = $request->thumbnail;
            }

            $this->documentRepository->update($id, $document);

            return redirect()->route('uploaded-document.index')->with('messageSuccess', trans('user.document.update_success'));
        } catch(Exception $e) {
            return redirect()->route('uploaded-document.index')->with('messageError', trans('user.document.update_fail'));
        }

        
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
            $this->documentRepository->destroy($id);

            return back()->with('message_success', trans('user.document.delete_success'));
        } catch(Exception $e) {
            return back()->with('message_fail', trans('user.delete_fail'));
        }
    }
}
