<?php

namespace App\Http\Controllers;
use App\Models\Reserva;
use App\Models\nuevaHabitacion;
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
     $fuentes=DB::table('FUENTE')->pluck('DESCRIPCION','CODIGO');

     $habitaciones= DB::table('HABITACION')
        ->join('TIPO_HABITACION','HABITACION.ID_TIPO_HABITACION','=','TIPO_HABITACION.ID_TIPO_HABITACION')
        ->select('HABITACION.ID_HABITACION','HABITACION.DETALLES','TIPO_HABITACION.DESCRIPCION')
        ->get();
     $reservas=habitacion_reserva::all();
     $precios = DB::table('PRECIO')->pluck('PRECIO');

     return view('reservas.create',compact('reservas','precios','habitaciones','fuentes','clientes','title'));
    }

     public function details(Reserva $reserva){
 	   // dd($currency);
         return view('reservas.details',compact('reserva'));
     }
     public function store(){
         $data = request()->all();
         dd($data);
         Reserva::create([
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
}
