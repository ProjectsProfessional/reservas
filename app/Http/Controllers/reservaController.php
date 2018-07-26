<?php

namespace App\Http\Controllers;
use App\Models\Reserva;
use App\Models\nuevaHabitacion;
use App\Models\habitaciones;
use App\Models\habitacion_reserva;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class reservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(){
         $reservas = Reserva::all();
         $title = 'Listado de reservas';
         return view('reservas.index', compact('reservas','title'));
     }
    public function create(){
     $title = 'Definir reservas';
     $clientes = DB::table('DBV_CLIENTES')->pluck('CLIENTE','ID_CLIENTE');
     $fuentes=DB::table('FUENTE')->pluck('CODIGO','ID_FUENTE');

     $habitaciones= DB::table('DBV_DETALLES_HAB')
         ->select('HABITACION','DESCRIPCION','TIPO_HAB','PRECIO')
         ->where([
             'ESTADO'=>'Activo',
             'MONEDA'=>'QTZ'
         ])
         ->get();

     $precios = DB::table('DBV_DETALLES_HAB')
         ->select('HABITACION','MONEDA','PRECIO')
         ->where('ESTADO','Activo')
         ->get();

     return view('reservas.create',compact('reservas','precios','habitaciones','fuentes','clientes','title','info'));
    }

     public function details(Reserva $reserva){
 	   // dd($currency);
         return view('reservas.details',compact('reserva'));
     }

     public function store(request $request){

          $reservation = new Reserva();
          $reservation->CODIGO = 'TODO:';
          $reservation->ID_CLIENTE = $request->cliente;
          $reservation->ID_FUENTE = $request->fuente;
          $reservation->ID_ESTADO_RESERVA = '1';
          //$reservation->PERSONAS = $request->personas;
          $reservation->FECHA_INGRESO = $request->fechaIngreso;
          $reservation->FECHA_RETIRO = $request->fechaSalida;
          $reservation->CODIGO_VUELO = $request->codigoVuelo;
          $reservation->save();

          for($i=0; $i<count($request->habitaciones);$i++){
              $detail = new habitacion_reserva();
              $detail->ID_HABITACION = $request->habitaciones[$i]["habitacion"];
              $detail->ID_RESERVA    = $reservation->ID_RESERVA;
              $detail->PRECIO = $request->habitaciones[$i]["precio"];
              $detail->save();
              //Es necesario actualizar las habitaciones como Reservadas
              $this->updateRoom($request->habitaciones[$i]["habitacion"]);

          }


         return response()->json(['message'=>'Se creado la reserva : '.$reservation->ID_RESERVA .' exitosamente']);
     }


     public function update(Reserva $reserva){
 	    $data = request()->all();
  	   	//dd($data);
 		$reserva->update([
 		    'CODIGO' => $data['code'],
            'DESCRIPCION'   => $data['description'],
  		   'ID_CLIENTE'   => $data['cliente'],
  		   'ID_FUENTE'   => $data['fuente'],
  		   'ID_ESTADO_RESERVA'   => $data['estado'],
  		   'FECHA_INGRESO'   => $data['fechaIngreso'],
  		   'FECHA_RETIRO'   => $data['fechaSalida'],
  		   'CODIGO_VUELO'   => $data['codigoVuelo'],
 		]);
 	    return redirect()->route('reservas');
     }

     private function updateRoom(int $id){

        $status = DB::table('ESTADO_HABITACION')
            ->select('ID_ESTADO_HABITACION')
            ->where('DESCRIPCION','Reservado')
            ->first();

        DB::table('HABITACION')
            ->where('ID_HABITACION',$id)
            ->update(['ID_ESTADO_HABITACION'=>$status->ID_ESTADO_HABITACION]);
     }
}
