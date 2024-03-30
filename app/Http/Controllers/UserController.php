<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
