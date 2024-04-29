<?php
namespace App\Http\Controllers;

use App\Models\Access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccessController extends Controller 

{

    public function index(Request $request)
    {

        $access = DB::select("SELECT a.id, date (a.fecha_hora_ingreso)as fecha, time (a.fecha_hora_ingreso) as hora, a.motivo, a.IdPuerta, a.status, a.destination, p.* FROM access a join person p on a.idPerson = p.id");
        return response()->json($access, 200);

    }
    public function Entrada(Request $request)
    {
        try {
            
            $messageRepsonse = 'Entrada registrada correctamente';
            $data = $request->all();
            $validateData = [
                'person_id' => 'required',
                'reason' => 'required',
                'destination' => 'required'
                
            ];
            $access =  $data['access'];
            $status = 1;

            if(isset($access) && $access['status'] == 1){
                $validateData = ['person_id' => 'required'];
                $messageRepsonse = 'Salida registrada correctamente';
                $status = 0;
            }   

            $request->validate($validateData);
        
            $access = new Access();
            $access->idPerson = $data['person_id']; 
            $access->fecha_hora_ingreso = date('Y-m-d H:i:s'); 
            $access->motivo = $data['reason']; 
            $access->IdPuerta  = 1; 
            $access->status = $status;
            $access->destination = $data['destination'];
            $access->save();

           
            return response()->json(['message' => $messageRepsonse], 200);
        } catch (\Exception $e) {
            
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
