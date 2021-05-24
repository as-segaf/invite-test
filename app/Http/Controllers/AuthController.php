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

        if ($user->is_admin == 0) {
            return redirect('/invitation');
        }

        return redirect('/vos/dashboard');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerAdmin()
    {
        return view('auth.register-admin');
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

    public function registerAdminPost(RegistrationRequest $request)
    {
        try {
            $data = $this->authService->registerAdmin($request);
        } catch (\Throwable $th) {
            return redirect('/register-admin')->with('error', $th->getMessage());
        }

        return redirect('/login')->with('success', 'Registration success, you can login with your data');
    }

    public function logout(Request $request)
    {
        try {
            $data = $this->authService->logout();
        } catch (\Throwable $th) {
            redirect('/invitation')->with('error', $th->getMessage());
        }

        return redirect('/login');
    }

    public function googleLogin()
    {
        try {
            $data = $this->authService->redirectToGoogle();
        } catch (\Throwable $th) {
            return redirect('/login')->with('error', $th->getMessage());
        }

        return $data;
    }

    public function googleLoginCallback()
    {
        try {
            $user = $this->authService->handleGoogleCallback();
        } catch (\Throwable $th) {
            return redirect('/login')->with('error', $th->getMessage());
        }

        if ($user->is_admin == 0) {
            return redirect('/invitation');
        }

        return redirect('/vos/invitation');
    }
}
