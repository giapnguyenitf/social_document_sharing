<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class NewDocumentController extends Controller
{
    protected $documentRepository;

    public function __construct(
        DocumentRepositoryInterface $documentRepository
    ) {
        $this->documentRepository = $documentRepository;
    }

    public function publishDocument($id)
    {
        try {
            $this->documentRepository->findOrFail($id);
            $this->documentRepository->where('id', $id)->update(['status' => config('settings.document.status.is_published')]);

            return back()->with('notificationSuccess', trans('admin.notifications.publish_document_success'));
        } catch (Exception $e) {
            return back()->with('notificationError', trans('admin.notifications.publish_document_fail'));
        }

    }
}
