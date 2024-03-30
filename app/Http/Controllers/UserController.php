<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registro(Request $request)
    {
       
        // Validar datos de entrada
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'type_users' => 'required',
           
        ]);

        // Crear un nuevo usuario
        //$usuario = new User([
            $usuario = User::updateOrCreate(['id' => $request->id],[
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type_users_id' => $request->type_users,
        ]);
        
        $message ='Usuario registrado satisfactoriamente';
        $redirect = 1;
        if(isset($request->id) && $request->id > 0){
            $message ='Usuario modificado satisfactoriamente';
            $redirect = 0;
        }

        return response()->json(['message' => $message ,"user"=> $usuario, 'redirect' => $redirect] , 201);

    }
    public function index()
    {
        $usuarios = User::all();
        return response()->json($usuarios);
    }

    public function borrar(Request $request)
    {

        $usuarios = User::where('id', $request->id)->first();

        if ($usuarios) {

            $usuarios->delete();

            return response()->json(['success' => true, 'message' => 'Usuario eliminado correctamente'], 200);
        } else {

            return response()->json(['success' => false, 'message' => 'El usuario no existe'], 404);
        }
    }
}
