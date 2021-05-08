<?php

namespace App\Interfaces;

interface UserRepositoryInterfaces
{
    public function createUser($request);

    public function createUserFromGoogle($data);
    
    public function findUserByGoogleId($googleId);
}
