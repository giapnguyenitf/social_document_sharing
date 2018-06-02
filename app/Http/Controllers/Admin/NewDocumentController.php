<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Events\DocumentEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\NotificationRepositoryInterface;

class NewDocumentController extends Controller
{
    protected $documentRepository;
    protected $notificationRepository;

    public function __construct(
        DocumentRepositoryInterface $documentRepository,
        NotificationRepositoryInterface $notificationRepository
    ) {
        $this->documentRepository = $documentRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function publishDocument($id)
    {
        try {
            $document = $this->documentRepository->findOrFail($id);
            $this->documentRepository->where('id', $id)->update(['status' => config('settings.document.status.is_published')]);
            $notification = $this->notificationRepository->create([
                'user_id' => $document->user_id,
                'message' => trans('user.notification_publish_document', ['document' => $document->name]),
                'status' => config('settings.notification.status.unread'),
            ]);
            event(new DocumentEvent($document->user_id, trans('user.notification_publish_document', ['document' => $document->name]), $notification->created_at->toDateTimeString()));

            return back()->with('notificationSuccess', trans('admin.notifications.publish_document_success'));
        } catch (Exception $e) {
            return back()->with('notificationError', trans('admin.notifications.publish_document_fail'));
        }
    }
}
