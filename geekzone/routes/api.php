<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\IsUserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// ———————————————————————————————————————————————————————————————————————————————
// RUTAS DE AUTENTICACIÓN
// ———————————————————————————————————————————————————————————————————————————————
// Rutas públicas
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

// Rutas protegidas
Route::middleware([IsUserAuth::class])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
    });
});
