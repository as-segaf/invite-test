<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware('guest')->except('logout');
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

    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(RegistrationRequest $request)
    {
        try {
            $data = $this->authService->register($request);
        } catch (\Throwable $th) {
            return redirect('/register')->with('error', $th->getMessage());
        }

        return redirect('/login')->with('success', 'Registration success, you can login with your data');
    }

    public function logout(Request $request)
    {
        try {
            $data = $this->authService->logout();
        } catch (\Throwable $th) {
            redirect('/home')->with('error', $th->getMessage());
        }

        return redirect('/login');
    }
}
