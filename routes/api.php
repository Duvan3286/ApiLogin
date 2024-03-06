<?php

use App\Http\Controllers\AuthController; // Importa el controlador AuthController
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Define una ruta protegida que devuelve los datos del usuario autenticado utilizando el middleware 'auth:sanctum'
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); // Devuelve los datos del usuario autenticado
});

// Define una ruta para el registro de usuarios utilizando el método 'registro' del controlador AuthController
Route::post('registro', [AuthController::class, 'registro']);

// Define una ruta para el inicio de sesión de usuarios utilizando el método 'login' del controlador AuthController
Route::post('login', [AuthController::class, 'login']);
