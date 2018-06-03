<?php

namespace App\Http\Controllers\User;

use Auth;
use Storage;
use Exception;
use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\BookmarkRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\NotificationRepositoryInterface;

class UserController extends Controller
{
    use UploadFileTrait;

    protected $userRepository;
    protected $documentRepository;
    protected $bookmarkRepository;
    protected $categoryRepository;
    protected $notificationRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        DocumentRepositoryInterface $documentRepository,
        BookmarkRepositoryInterface  $bookmarkRepository,
        CategoryRepositoryInterface $categoryRepository,
        NotificationRepositoryInterface $notificationRepository
    ) {
        $this->userRepository = $userRepository;
        $this->documentRepository = $documentRepository;
        $this->bookmarkRepository = $bookmarkRepository;
        $this->categoryRepository = $categoryRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        $notifications = $this->notificationRepository->getAll(auth()->user()->id);

        return view('user.pages.profiles', compact('categories', 'notifications'));
    }

    public function show($slug)
    {
        try {
            $notifications = [];

            if (Auth::check()) {
                if (Auth::user()->slug == $slug) {
                    return redirect()->route('manage-profile');
                }
                $notifications = $this->notificationRepository->getAll(auth()->user()->id);
            }

            $categories = $this->categoryRepository->getAll();
            $user = $this->userRepository->where('slug', $slug)->firstOrFail();
            $uploadeds = $this->documentRepository->where('status', config('settings.document.status.is_published'))
                ->where('user_id', $user->id)
                ->get();

            return view('user.pages.user-profile', compact('user', 'uploadeds', 'categories', 'notifications'));
        } catch (Exception $e) {
            return view('errors.404');
        }
    }

    public function update(UpdateProfileRequest $request)
    {
        try {
            $authUser = Auth::user();
            $user = $request->only([
                'name',
                'date_of_birth',
                'address',
                'gender',
                'phone',
            ]);

            $this->userRepository->where('id', $authUser->id )->update($user);

            return back()->with('messageSuccess', trans('user.profile.update_success'));

        } catch(Exception $e) {
            return back()->with('messageError', trans('user.profile.update_fail'));
        }
    }

    public function showUploaded()
    {
        try {
            $categories = $this->categoryRepository->getAll();
            $user = Auth::user();
            $uploadeds = $this->documentRepository->where('user_id', $user->id)->get();
            $notifications = $this->notificationRepository->getAll(auth()->user()->id);

            return view('user.pages.uploaded', compact('uploadeds', 'categories', 'notifications'));
        } catch (Exception $e) {
            return view('errors.404');
        }
    }

    public function showDownloaded()
    {
        try {
            $categories = $this->categoryRepository->getAll();
            $user = Auth::user();
            $dowloadedsId = explode(',', $user->downloaded);
            $downloadeds = $this->documentRepository->withTrashed()
            ->whereIn('id', $dowloadedsId)
            ->get();
            $notifications = $this->notificationRepository->getAll(auth()->user()->id);

            return view('user.pages.downloaded', compact('downloadeds', 'categories', 'notifications'));
        } catch(Exception $e) {
            return view('errors.404');
        }
    }

    public function changeAvatar(Request $request)
    {
        if ($request->has('avatar')) {
            $authUser = auth()->user();
            $avatarPath = $this->uploadFile(config('settings.avatar.path_store'), $request->avatar);

            if (Storage::disk('local')->exists($authUser->avatar)) {
                Storage::disk('local')->delete($authUser->avatar);
            }

            $this->userRepository->where('id', Auth::user()->id)->update([
                'avatar' => $avatarPath,
            ]);
        }

        return back();
    }

    public function showChangePassword()
    {
        $categories = $this->categoryRepository->getAll();
        $notifications = $this->notificationRepository->getAll(auth()->user()->id);

        return view('user.pages.change-password', compact('categories', 'notifications'));
    }

    public function changePassword(ChangePasswordRequest $request) {
        $credentials['password'] = $request->old_password;
        $credentials['email'] = auth()->user()->email;

        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $user->password_hash = $request->password;
            $this->userRepository->where('id', $user->id)->update(['password' => $user->password]);

            return back()->with('messageSuccess', trans('user.profile.change_password_success'));
        }

        return back()->withErrors(['old_password' => trans('user.profile.password_incorrect')]);
    }
}
