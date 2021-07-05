<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{ RegisterController, LoginController, Authenticated };
use App\Http\Controllers\{ HomeController };


Route::middleware('auth:sanctum')->get('/authenticated', [Authenticated::class, 'index']);

Route::get('home' , [HomeController::class, 'index']);

Route::post('register' , [RegisterController::class, 'register']);
Route::post('login' , [LoginController::class, 'login']);
Route::post('logout' , [LoginController::class, 'logout']);
