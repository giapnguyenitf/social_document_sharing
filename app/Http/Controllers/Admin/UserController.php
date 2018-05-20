<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;
    protected $documentRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        DocumentRepositoryInterface $documentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->documentRepository = $documentRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAllUsers();

        return view('admin.pages.listUser', compact('users'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($slug)
    {
        try {
            $user = $this->userRepository->with('documents')->where('slug', $slug)->firstOrFail();
            $uploadeds = $this->documentRepository->getUploadedDocument($user->id);

            return view('admin.pages.viewInfoUser', compact('user', 'uploadeds'));
        } catch (Exception $e) {
            return back()->with('notificationError', trans('admin.notifications.user_not_found'));
        }
    }

    public function showModerator()
    {
        $moderators = $this->userRepository->getAllModerators();

        return view('admin.pages.listModerator', compact('moderators'));
    }

    public function block($id)
    {
        try {
            $user = $this->userRepository->findOrFail($id);
            $this->userRepository->where('id', $id)->update(['is_ban' => config('settings.is_ban.true')]);

            return back()->with('notificationSuccess', trans('admin.notifications.block_user_success', ['user' => $user->name]));
        } catch (Exception $e) {
            return back()->with('notificationError', trans('admin.notifications.user_not_found'));
        }
    }

    public function unblock($id)
    {
        try {
            $user = $this->userRepository->findOrFail($id);
            $this->userRepository->where('id', $id)->update(['is_ban' => config('settings.is_ban.false')]);

            return back()->with('notificationSuccess', trans('admin.notifications.unblock_user_success', ['user' => $user->name]));
        } catch (Exception $e) {
            return back()->with('notificationError', trans('admin.notifications.user_not_found'));
        }
    }

    public function showBlockedUsers()
    {
        $blockedUsers = $this->userRepository->getAllBlockedUsers();

        return view('admin.pages.listBlockedUser', compact('blockedUsers'));
    }

    public function showBlockedMods()
    {
        $blockedMods = $this->userRepository->getAllBlockedMods();

        return view('admin.pages.listBlockedMod', compact('blockedMods'));
    }
}
