<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{ RegisterController, LoginController, Authenticated };
use App\Http\Controllers\{ HomeController };
use App\Http\Controllers\User\{ ClienteController, ShopcartController, OrderController };
use App\Http\Controllers\Admin\{ EmpresaController };

Route::middleware('auth:sanctum')->get('/authenticated', [Authenticated::class, 'index']);

Route::get('home' , [HomeController::class, 'index']);
Route::get('empresas' , [HomeController::class, 'getAllEmpresas']);

Route::post('register' , [RegisterController::class, 'register']);
Route::post('login' , [LoginController::class, 'login']);
Route::post('logout' , [LoginController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('usuario')->group(function () {
        Route::get('findOneCliente' , [ClienteController::class, 'findOneCliente']);
        Route::get('findUser' , [ClienteController::class, 'findUser']);
        Route::resource('cliente', ClienteController::class)->only(['store']);
        Route::get('findOneProduto/{id}' , [ShopcartController::class, 'findOneProduto']);
        Route::post('createOrder' , [ShopcartController::class, 'createOrder']);
        Route::get('order/{cliete_id}' , [OrderController::class, 'findAllOrderByClient']);
    });

    Route::prefix('admin')->group(function () {
        Route::resource('/empresa', EmpresaController::class)->only(['index','store']);
    });
});
