<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registro(Request $request)
    {
       
        // Validar datos de entrada
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'type_users' => 'required',
           
        ]);

        // Crear un nuevo usuario
        $usuario = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type_users_id' => $request->type_users,
        ]);

        // Guardar el usuario en la base de datos
        $usuario->save();

        return response()->json(['message' => 'Usuario registrado satisfactoriamente',"user"=> $usuario], 201);
    }

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
