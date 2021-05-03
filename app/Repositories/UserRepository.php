<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterfaces;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterfaces
{
    public function createUser($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if (!$user) {
            throw new Exception("Failed to create user", 1);
        }

        return $user;
    }
}
