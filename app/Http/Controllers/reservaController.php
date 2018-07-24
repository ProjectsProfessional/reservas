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
     public function store(){
         $data = request()->all();
         dd($data);
         Reserva::create([
            'CODIGO' => $data['code'],
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
