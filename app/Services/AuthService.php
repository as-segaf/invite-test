<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterfaces;
use Illuminate\Support\Facades\Auth;

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
}
