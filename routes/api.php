<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{ RegisterController, LoginController };


Route::middleware('auth:sanctum')->get('/authenticated', function (Request $request) {
    return response()->json($request->user());
});

Route::post('register' , [RegisterController::class, 'register']);
Route::post('login' , [LoginController::class, 'login']);
Route::post('logout' , [LoginController::class, 'logout']);
