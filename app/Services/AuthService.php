<?php

namespace App\Services;

class AuthService
{
    public function login($request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            throw new Exception("Email and password doesn't match", 1);
        }

        return auth()->user();
    }
}
