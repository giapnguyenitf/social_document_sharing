<?php

namespace App\Http\Controllers\User;

use Auth;
use Storage;
use Exception;
use Illuminate\Http\Request;
use App\Traits\UploadFileTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\BookmarkRepositoryInterface;

class UserController extends Controller
{
    use UploadFileTrait;

    protected $userRepository;
    protected $documentRepository;
    protected $bookmarkRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        DocumentRepositoryInterface $documentRepository,
        BookmarkRepositoryInterface  $bookmarkRepository
    ) {
        $this->userRepository = $userRepository;
        $this->documentRepository = $documentRepository;
        $this->bookmarkRepository = $bookmarkRepository;
    }

    public function index()
    {
        return view('user.pages.profiles');
    }

    public function show($id)
    {
        try {
            if (Auth::check()) {
                if (Auth::user()->id == $id) {
                    return redirect()->route('manage-profile');
                }
            }

            $user = $this->userRepository->findOrFail($id);
            $uploadeds = $this->documentRepository->where('status', config('settings.document.status.is_published'))
                ->where('user_id', $user->id)
                ->get();

            return view('user.pages.user-profile', compact('user', 'uploadeds'));
        } catch (Exception $e) {
            return back()->with('messageError', trans('user.notifications.user_not_found'));
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

            $this->userRepository->update($authUser->id ,$user);

            return back()->with('messageSuccess', trans('user.profile.update_success'));

        } catch(Exception $e) {
            return back()->with('messageError', trans('user.profile.update_fail'));
        }
    }

    public function showUploaded()
    {
        try {
            $user = Auth::user();
             $uploadeds = $this->documentRepository->withTrashed()
                ->where('user_id', $user->id)
                ->get();

            return view('user.pages.uploaded', compact('uploadeds'));
        } catch (Exception $e) {
            return back();
        }
    }

    public function showDownloaded()
    {
        try {
            $user = Auth::user();
            $dowloadedsId = explode(',', $user->downloaded);
            $downloadeds = $this->documentRepository->withTrashed()
            ->whereIn('id', $dowloadedsId)
            ->get();

            return view('user.pages.downloaded', compact('downloadeds'));
        } catch(Exception $e) {
            return back();
        }
    }
}
