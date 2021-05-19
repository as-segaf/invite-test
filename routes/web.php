<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\VosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/google', [AuthController::class, 'googleLogin']);
Route::get('/auth/google/callback', [AuthController::class, 'googleLoginCallback']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerPost']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function() {
    Route::middleware('admin')->prefix('vos')->group(function() {
        Route::resource('invitation', VosController::class)->only('index', 'update');
    });

    Route::middleware('user')->group(function() {
        Route::resource('invitation', InvitationController::class)->except('create', 'show', 'edit');
    });
});