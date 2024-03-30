<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   

     public function login(Request $request)
{
    // Validar datos de entrada
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
        
    ]);

    // Verificar credenciales del usuario
    if (! $token  = auth()->attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Credenciales incorrectas', 'status' => false], 401);
    }

   if($token){
    
    return response()->json(['message' => 'Autenticacion exitosa', 'status' => true,'user' => auth()->user()], 200);
   }
}
}
