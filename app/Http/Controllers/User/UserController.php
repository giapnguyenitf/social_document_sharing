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

class UserController extends Controller
{
    use UploadFileTrait;

    protected $userRepository;
    protected $documentRepository;
    protected $bookmarkRepository;
    protected $categoryRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        DocumentRepositoryInterface $documentRepository,
        BookmarkRepositoryInterface  $bookmarkRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->userRepository = $userRepository;
        $this->documentRepository = $documentRepository;
        $this->bookmarkRepository = $bookmarkRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();

        return view('user.pages.profiles', compact('categories'));
    }

    public function show($slug)
    {
        try {
            if (Auth::check()) {
                if (Auth::user()->slug == $slug) {
                    return redirect()->route('manage-profile');
                }
            }

            $categories = $this->categoryRepository->getAll();
            $user = $this->userRepository->where('slug', $slug)->firstOrFail();
            $uploadeds = $this->documentRepository->where('status', config('settings.document.status.is_published'))
                ->where('user_id', $user->id)
                ->get();

            return view('user.pages.user-profile', compact('user', 'uploadeds', 'categories'));
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
                'email',
                'date_of_birth',
                'address',
                'gender',
                'phone',
            ]);

            if ($request->has('avatar')) {
                $fileAvatar = $request->file('avatar');
                $filePath = $this->uploadFile(config('settings.avatar.path_store'), $fileAvatar);
                $user['avatar'] = $filePath;

                if (Storage::disk('local')->exists($authUser->avatar)) {
                    Storage::disk('local')->delete($authUser->avatar);
                }
            }

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

            return view('user.pages.uploaded', compact('uploadeds', 'categories'));
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

            return view('user.pages.downloaded', compact('downloadeds', 'categories'));
        } catch(Exception $e) {
            return view('errors.404');
        }
    }

    public function changeAvatar(Request $request)
    {
        if ($request->has('avatar')) {
            $avatarPath = $this->uploadFile(config('settings.avatar.path_store'), $request->avatar);
            $this->userRepository->where('id', Auth::user()->id)->update([
                'avatar' => $avatarPath,
            ]);
        }

        return back();
    }

    public function showChangePassword()
    {
        $categories = $this->categoryRepository->getAll();

        return view('user.pages.change-password', compact('categories'));
    }

    public function changePassword(ChangePasswordRequest $request) {
        $credentials['password'] = $request->old_password;
        $credentials['email'] = auth()->user()->email;

        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $user->password_hash = $request->password;
            $this->userRepository->where('id', $user->id)->update(['password' => $user->password_hash]);

            return back()->with('messageSuccess', trans('user.profile.change_password_success'));
        }

        return back()->withErrors(['old_password' => trans('user.profile.password_incorrect')]);
    }
}
