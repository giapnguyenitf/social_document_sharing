<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ReportRepositoryInterface;

class DocumentController extends Controller
{
    protected $documentRepository;
    protected $categoryRepository;
    protected $reportRepository;

    public function __construct(
        DocumentRepositoryInterface $documentRepository,
        CategoryRepositoryInterface $categoryRepository,
        ReportRepositoryInterface $reportRepository
    ) {
        $this->documentRepository = $documentRepository;
        $this->categoryRepository = $categoryRepository;
        $this->reportRepository = $reportRepository;
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
            $document = $this->documentRepository->withTrashed()->where('slug', $slug)->firstOrFail();
            $categories = $this->categoryRepository->getAll();

            if ($user->can('edit', $document)) {
                return view('admin.pages.editInfoDocument', compact('document', 'categories'));
            }

            return view('errors.403');
        } catch (Exception $e) {
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

            return view('errors.403');
        } catch (Exception $e) {
            return view('errors.404');
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
            return view('errors.404');
        }
    }

    public function restore($id)
    {
        try {
            $document = $this->documentRepository->withTrashed()->findOrFail($id);
            $document->restore();

            return back()->with('notificationSuccess', trans('admin.notifications.restore_document_success', ['document' => $document->name]));
        } catch (Exception $e) {
            return view('errors.404');
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

    public function showDeleted()
    {
        $documents = $this->documentRepository->getAllTrashed();

        return view('admin.pages.deletedDocument', compact('documents'));
    }

    public function showReported()
    {
        $documents = $this->documentRepository->getAllReport();

        return view('admin.pages.listReportedDocument', compact('documents'));
    }

    public function showDetailReport($slug)
    {
        $categories = $this->categoryRepository->getAll();
        $document = $this->documentRepository->with(['reports' => function ($query) {
            $query->with('user');
        }])->where('slug', $slug)->firstOrFail();
        $this->reportRepository->where('document_id', $document->id)->update(['status' => config('settings.report.status.read')]);

        return view('admin.pages.detailReportDocument', compact('document', 'categories'));
    }
}
