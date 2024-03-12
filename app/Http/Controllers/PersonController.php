<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public function registro(Request $request)
    {
       
        // Validar datos de entrada
        $request->validate([
            'identification'=>'required|string',
            'name' => 'required|string',
            'lastname' => 'required|string',
            'type_person_id' => 'required|string',
            'job' => 'required|string',
            'destination' => 'required|string',
            'address'=>'required|string',
            'phone'=>'required|string',
            'email'=>'required|string',
            'reason' => 'required|string',
        ]);

        // Crear un nueva persona
        $person = new person([
            'identification' => $request->identification,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'type_person_id' => $request->type_person_id,
            'job' => $request->job,
            'destination' => $request->destination,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'reason' => $request->reason
        ]);

        // Guardar el usuario en la base de datos
        $person->save();

        return response()->json(['message' => 'persona registrada satisfactoriamente',"person"=> $person], 201);
    }

    
}
