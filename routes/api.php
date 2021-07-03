<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{ RegisterController, LoginController };


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register' , [RegisterController::class, 'register']);
Route::post('login' , [LoginController::class, 'login']);
Route::post('logout' , [LoginController::class, 'logout']);
