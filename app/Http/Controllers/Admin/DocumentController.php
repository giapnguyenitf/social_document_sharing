<?php

namespace App\Http\Controllers\Admin;

use Auth;
// use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class DocumentController extends Controller
{
    protected $documentRepository;

    public function __construct(
        DocumentRepositoryInterface $documentRepository
    ) {
        $this->documentRepository = $documentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = $this->documentRepository->getChecking();

        return view('admin.pages.newDocument', compact('documents'));
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
    public function edit($slug)
    {
        try {
            $user = Auth::user();
            $document = $this->documentRepository->getDocument($slug);

            if ($user->can('edit', $document)) {
                return view('admin.pages.editInfoDocument', compact('document'));
            }

            return back()->with('notificationError', trans('admin.notifications.you_are_not_allowed_to_edit_this_document'));
        } catch (Exception $e) {
            return back()->with('messageError', trans('admin.notifications.document_not_found'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        try {
            $document = $this->documentRepository->getDocument($slug);
            $user = Auth::user();
            $data = $request->only([
                'name',
                'description',
                'file_name',
                'thumbnail',
                'category_id',
                'status',
            ]);

            if ($user->can('update', $document)) {
                $this->documentRepository->where('id', $document->id)->update($data);

                return redirect()->route('manage-document.index')
                    ->with('notificationSuccess', trans('admin.notifications.update_document_success'));
            }

            return back()->with('notificationError', trans('admin.notifications.you_are_not_allowed_to_edit_this_document'));
        } catch (Exception $e) {
            return back()->with('notificationError', trans('admin.notifications.document_not_found'));
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
            $document = $this->documentRepository->getDocument($slug);
            $user = Auth::user();

            if ($user->can('delete', $document)) {
                $this->documentRepository->destroy($document->id);

                return back()->with('notificationSuccess', trans('admin.notifications.delete_document_success'));
            }

            return view('errors.403');
        } catch (Exception $e) {
            return back()->with('messageError', trans('admin.notifications.document_not_found'));
        }
    }

    public function showPublished()
    {
        $documents = $this->documentRepository->getPublished();

        return view('admin.pages.publicDocument', compact('documents'));
    }

    public function showIllegal()
    {
        $documents = $this->documentRepository->getIllegal();

        return view('admin.pages.illegalDocument', compact('documents'));
    }
}
