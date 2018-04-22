<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Exception;
use Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;

class SocialLoginController extends Controller
{
    protected $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function redirectToProvider($provider)
    {
          return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try
        {
            $user = Socialite::driver($provider)->user();
            $authUser = $this->findOrCreateUser($user, $provider);
            Auth::login($authUser, true);
            
            return redirect()->route('home');
        } catch(Exception $e) {
            return back();
        }
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = $this->userRepository->findByField('provider_id', $user->id);

        if ($authUser) {
            return $authUser;
        }
       
        return $this->userRepository->create([
            'name' => $user->name,
            'avatar' => str_replace('?sz=50', '?sz=200', $user->avatar),
            'provider' => $provider,
            'provider_id' => $user->id,
        ]);
    }
}
