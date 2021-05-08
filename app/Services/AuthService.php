<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterfaces;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterfaces $userRepository)
    {
        return $this->userRepository = $userRepository;
    }

    public function login($request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            throw new Exception("Email and password doesn't match", 1);
        }

        return auth()->user();
    }

    public function register($request)
    {
        return $this->userRepository->createUser($request);
    }

    public function logout()
    {
        return Auth::logout();
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = $this->userRepository->findUserByGoogleId($googleUser->id);

        if (!$user) {
            $User = $this->userRepository->createUserFromGoogle($user);
        }
        
        $data = Auth::login($user);

        if (!$data) {
            throw new Exception("Login to app failed", 1);
        }

        return $data;
    }
}
