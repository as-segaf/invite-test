<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterfaces;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterfaces
{
    public function createAdmin($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 1,
        ]);

        if (!$user) {
            throw new Exception("Failed to create admin", 1);
        }
    }

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

    public function createUserFromGoogle($data)
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make('secret123'),
        ]);

        if (!$user) {
            throw new Exception("Failed to create user", 1);
        }

        return $user;
    }

    public function findUserByGoogleId($googleId)
    {
        $user = User::where('google_id', $googleId)->first();

        return $user;
    }

    public function findUserByEmail($email)
    {
        $user = User::where('email', $email)->first();

        return $user;
    }
}
