<?php

namespace App\Interfaces;

interface UserRepositoryInterfaces
{
    public function createAdmin($request);
    
    public function createUser($request);

    public function createUserFromGoogle($data);
    
    public function findUserByGoogleId($googleId);

    public function findUserByEmail($email);
}
