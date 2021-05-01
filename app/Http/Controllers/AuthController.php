<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        return $this->authService = $authService;
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(LoginRequest $request)
    {
        try {
            $user = $this->authService->login($request);
        } catch (\Throwable $th) {
            return redirect('/login')->with('error', $th->getMessage());
        }

        return redirect('/home');
    }
}
