<?php
namespace App\Http\Controllers;

use App\Models\Access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccessController extends Controller 

{

    public function index(Request $request)
    {

        $access = DB::select("SELECT a.id, a.fecha_hora_ingreso, a.motivo, a.IdPuerta, p.* FROM access a join person p on a.idPerson = p.id");
        return response()->json($access, 200);

    }
    public function Entrada(Request $request)
    {
        try {
            
            $data = $request->all();
            $request->validate([

                'person_id' => 'required',
                'reason' => 'required',
                'destination' => 'required'
                
            ]);
        
            $access = new Access();
            $access->idPerson = $data['person_id']; 
            $access->fecha_hora_ingreso = date('Y-m-d H:i:s'); 
            $access->motivo = $data['reason']; 
            $access->IdPuerta  = 1; 
            $access->save();

           
            return response()->json(['message' => 'Entrada registrada correctamente'], 200);
        } catch (\Exception $e) {
            
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
