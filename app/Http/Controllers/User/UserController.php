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

class UserController extends Controller
{
    use UploadFileTrait;

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
       try {
            $authUser = Auth::user();
            $user = $this->userRepository->find($authUser->id);

            return view('user.pages.profile', compact('user'));
       } catch(Exception $e) {
           return back();
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

            return back()->with('message', trans('user.profile.update_success'));

        } catch(Exception $e) {
            return back()->with('message', trans('user.profile.update_success'));
        }
    }
}
