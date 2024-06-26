<?php

namespace App\Http\Controllers;

use App\Models\Access;
use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public function registro(Request $request)
    {

        // Validar datos de entrada
        $request->validate([
            'identification' => 'required|string',
            'name' => 'required|string',
            'lastname' => 'required|string',
            //'type_person_id' => 'required|string',
            'job' => 'required|string',
            //'destination' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            //'reason' => 'required|string',
        ]);

        
            $person = Person::updateOrCreate(['id' => $request->id],[
                'identification' => $request->identification,
                'name' => $request->name,
                'lastname' => $request->lastname,
                'type_person_id' => $request->type_person_id,
                'job' => $request->job,
                //'destination' => $request->destination,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                //'reason' => $request->reason
            ]);
        


       

        return response()->json(['message' => 'persona registrada satisfactoriamente', "person" => $person], 201);
    }


    public function buscar(Request $request)
    {

        $personData = Person::where('identification', $request->identification)->first();
        $checkAccess = array();
        if($personData){
            $checkAccess = Access::where(['idPerson' => $personData->id])->orderBy('id', 'desc')->first();
        }
        return response()->json(["person" => $personData, 'access' => $checkAccess], 200);
    }


    public function borrar(Request $request)
    {
        $person = Person::find($request->id);
    
        if ($person) {
            $person->delete();
            return response()->json(['success' => true, 'message' => 'Persona eliminada correctamente'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'La persona no existe'], 404);
        }
    }

    public function index()
    {

        $people = Person::all(); 
        return response()->json($people); 
    }
    

   
}
