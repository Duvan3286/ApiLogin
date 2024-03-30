<?php


use App\Http\Controllers\AuthController; 
use App\Http\Controllers\PersonController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
});

Route::post('registro', [AuthController::class, 'registro']);

Route::post('login', [AuthController::class, 'login']);

Route::post('/register_person', [PersonController::class, 'registro']);

Route::post('/search_person', [PersonController::class, 'buscar']);

Route::delete('/delete_person/{id}', [PersonController::class, 'borrar']);

Route::get('usuarios', [UserController::class, 'index']);

Route::delete('/delete_user/{id}', [UserController::class, 'borrar']);
