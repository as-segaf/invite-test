<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterfaces;
use App\Models\User;
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

    public function createUserFromGoogle($data)
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'google_id' => $data->id,
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
}
