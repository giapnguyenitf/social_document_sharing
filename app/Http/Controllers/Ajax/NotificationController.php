<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\NotificationRepositoryInterface;

class NotificationController extends Controller
{
    protected $notificationRepository;

    public function __construct(
        NotificationRepositoryInterface $notificationRepository
    ) {
        $this->notificationRepository = $notificationRepository;
    }
    public function readAll(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }

        $this->notificationRepository->where('user_id', $request->userId)
            ->update(['status' => config('settings.notification.status.read')]);

        return response()->json([
            'success' => true,
        ]);
    }
}
