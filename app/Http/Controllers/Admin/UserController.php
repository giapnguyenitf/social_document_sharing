<?php

namespace App\Http\Controllers\Admin;

// use Exception;
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
        if (auth()->user()->isAdmin()) {
            $moderators = $this->userRepository->getAllModerators();

            return view('admin.pages.listModerator', compact('moderators'));
        }

        return view('errors.403');
    }

    public function block($id)
    {
        try {
            $user = $this->userRepository->findOrFail($id);
            if (auth()->user()->can('block', $user)) {
                 $this->userRepository->where('id', $id)->update(['is_ban' => config('settings.is_ban.true')]);

                return back()->with('notificationSuccess', trans('admin.notifications.block_user_success', ['user' => $user->name]));
            }

            return view('errors.403');
        } catch (Exception $e) {
            return back()->with('notificationError', trans('admin.notifications.user_not_found'));
        }
    }

    public function unblock($id)
    {
        try {
            $user = $this->userRepository->findOrFail($id);
            if (auth()->user()->can('block', $user)) {
                $this->userRepository->where('id', $id)->update(['is_ban' => config('settings.is_ban.false')]);

                return back()->with('notificationSuccess', trans('admin.notifications.unblock_user_success', ['user' => $user->name]));
            }

            return view('errors.403');
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
        if (auth()->user()->isAdmin()) {
            $blockedMods = $this->userRepository->getAllBlockedMods();

            return view('admin.pages.listBlockedMod', compact('blockedMods'));
        }

        return view('errors.403');
    }

    public function setModerator($slug)
    {
        try {
            $user = $this->userRepository->where('slug', $slug)->firstOrFail();
            if (auth()->user()->isAdmin()) {
                $this->userRepository->where('id', $user->id)->update(['rules' => config('settings.rules.is_moderator')]);

                return back()->with('notificationSuccess', trans('admin.notifications.set_moderator_success', ['user' => $user->name]));
            }

            return view('errors.403');
        } catch (Exception $e) {
            return view('errors.404');
        }
    }

    public function unsetModerator($slug)
    {
        try {
            $user = $this->userRepository->where('slug', $slug)->firstOrFail();
            if (auth()->user()->isAdmin()) {
                $this->userRepository->where('id', $user->id)->update(['rules' => config('settings.rules.is_user')]);

                return back()->with('notificationSuccess', trans('admin.notifications.unset_moderator_success', ['user' => $user->name]));
            }

            return view('errors.403');
        } catch (Exception $e) {
            return view('errors.404');
        }
    }
}
