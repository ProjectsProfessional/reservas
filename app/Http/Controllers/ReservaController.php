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
	  	   $reservas=DB::table('RESERVA')
	  	   	->JOIN('CLIENTE', 'RESERVA.ID_CLIENTE', '=', 'CLIENTE.ID_CLIENTE')
	  		->JOIN('FUENTE', 'FUENTE.ID_FUENTE', '=', 'RESERVA.ID_FUENTE')
	  		->JOIN('ESTADO_RESERVA', 'ESTADO_RESERVA.ID_ESTADO_RESERVA','=', 'RESERVA.ID_ESTADO_RESERVA')
	  		->SELECT('CLIENTE.NOMBRE1 AS NOMBRE', 'CLIENTE.APELLIDO1 AS APELLIDO', 'ESTADO_RESERVA.DESCRIPCION AS ESTADO', 'FUENTE.CODIGO AS FUENTE','RESERVA.PERSONAS',
	  		'RESERVA.CODIGO',DB::raw('DATE_FORMAT(FECHA_INGRESO,\' %d /%m /%Y\') AS FECHA_INGRESO,DATE_FORMAT(RESERVA.FECHA_RETIRO,\'%d/%m/%Y\') AS FECHA_RETIRO'),
			 'RESERVA.CODIGO_VUELO', 'RESERVA.ID_RESERVA')->get();

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
             'MONEDA'=>'USD'
         ])
         ->get();

     $precios = DB::table('DBV_DETALLES_HAB')
         ->select('HABITACION','MONEDA','PRECIO')
         ->where('ESTADO','Activo')
         ->get();

     return view('reservas.create',compact('reservas','precios','habitaciones','fuentes','clientes','title','info'));
    }

     public function details(){
 	   // dd($currency);

         return view('reservas.details',compact('reserva', 'id'));
     }

     public function store(request $request){

          $reservation = new Reserva();
          $reservation->CODIGO = 'TODO:';
          $reservation->ID_CLIENTE = $request->cliente;
          $reservation->ID_FUENTE = $request->fuente;
          $reservation->ID_ESTADO_RESERVA = '1';
          $reservation->PERSONAS = $request->personas;
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
              //Es necesario actualizar las habitaciones como Reservadas.
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
	public function destroy(Reserva $reserva)
	{
		$id=$reserva->ID_RESERVA;
		dd($id);
		$deleted = DB::delete('delete from reservas where reserva.id_reserva = ? and habitacion_reserva.id_reserva', [$id]);
	     return redirect()->route('reservas');
	}
}
