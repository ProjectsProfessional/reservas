<?php

namespace App\Http\Controllers;
use App\Models\Currency;
use App\Models\Reserva;
use App\Models\nuevaHabitacion;
use App\Models\habitaciones;
use App\Models\habitacion_reserva;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReservaController extends Controller
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
			 'RESERVA.CODIGO_VUELO', 'RESERVA.ID_RESERVA')->paginate(10);


	  	   $currencies = Currency::all();

         return view('reservas.index', compact('reservas','currencies'));
     }

    public function create(){
        /*
         * Evaluo si las fechas solicitadas se encuentran disponibles.
         * */
        $data = request()->all();
        $rooms = $this->showRooms($data['dateIn'],$data['dateOut'],$data['currency']);

        if ((count($rooms['habitaciones'])>0) && (count($rooms['precios'])>0)){
            $dateIn = $data['dateIn'];
            $dateOut = $data['dateOut'];
            //puedo levantar con la vista de habitaciones
            $habitaciones = $rooms['habitaciones'];
            $precios =$rooms['precios'];

            $title = 'Definir reservas';
            $clientes = DB::table('DBV_CLIENTES')->pluck('CLIENTE','ID_CLIENTE');
            $fuentes=DB::table('FUENTE')->pluck('CODIGO','ID_FUENTE');
            return view('reservas.create',compact('title','clientes','fuentes','habitaciones','precios','dateIn','dateOut'));
        }elseif ((count($rooms['habitaciones'])>0) && (count($rooms['precios'])<=0)){
            return redirect()->route('reservas')->with('warning', 'No se han definido precios en '.$data['currency'] .' para las habitaciones disponibles.');
        }
        return redirect()->route('reservas')->with('warning', 'Todas las habitaciones se encuentran reservadas en la fecha seleccionada.');
    }

    public function showRooms($dateIn,$dateOut,$currency){

        $habitaciones= DB::table('DBV_HABITACIONES_DISP')
            ->select('HABITACION','DESCRIPCION','TIPO_HAB')
            ->whereRaw('HABITACION NOT IN(SELECT T0.HABITACION FROM DBV_HABITACIONES_DISP T0 WHERE 
                T0.FECHA_INGRESO = ? OR (T0.FECHA_INGRESO = ? AND T0.FECHA_RETIRO = ?))',
                [$dateIn,$dateIn, $dateOut]
            )
            ->groupBy('HABITACION','DESCRIPCION','TIPO_HAB')
            ->get();

        $precios = DB::table('DBV_HABITACIONES_DISP')
            ->select('DBV_HABITACIONES_DISP.HABITACION','PERSONAS','MONEDA','PRECIO')
            ->join('DBV_PRECIOS_ASIGNADOS','DBV_HABITACIONES_DISP.ID_TIPO_HABITACION','DBV_PRECIOS_ASIGNADOS.ID_TIPO_HABITACION')
            ->whereRaw('HABITACION NOT IN(SELECT T0.HABITACION FROM DBV_HABITACIONES_DISP T0 WHERE 
                T0.FECHA_INGRESO = ? OR (T0.FECHA_INGRESO = ? AND T0.FECHA_RETIRO = ?)) AND MONEDA = ?',
                [$dateIn,$dateIn, $dateOut,$currency]
            )
            ->groupBy('DBV_HABITACIONES_DISP.HABITACION','PERSONAS','MONEDA','PRECIO')
            ->get();
        return (compact('habitaciones','precios'));
    }

     public function details(){
         return view('reservas.details',compact('reserva', 'id'));
     }

     public function store(request $request)
     {

         $reservation = new Reserva();
         $reservation->CODIGO = $request->code;
         $reservation->ID_CLIENTE = $request->cliente;
         $reservation->ID_FUENTE = $request->fuente;
         $reservation->ID_ESTADO_RESERVA = '1';
         $reservation->PERSONAS = $request->personas;
         $reservation->FECHA_INGRESO = $request->fechaIngreso;
         $reservation->FECHA_RETIRO = $request->fechaSalida;
         $reservation->CODIGO_VUELO = $request->codigoVuelo;

         DB::beginTransaction();

         $reservation->save();

         for ($i = 0; $i < count($request->habitaciones); $i++) {
             $detail = new habitacion_reserva();
             $detail->ID_HABITACION = $request->habitaciones[$i]["habitacion"];
             $detail->ID_RESERVA = $reservation->ID_RESERVA;
             $detail->ID_RESERVA = $reservation->ID_RESERVA;
             $detail->PRECIO = $request->habitaciones[$i]["precio"];
             $detail->save();
             //Es necesario actualizar las habitaciones como Reservadas.
             //$this->updateRoom($request->habitaciones[$i]["habitacion"]);

             DB::commit();
         }
         DB::rollBack();
         return response()->json(['message'=>'Se creado la reserva : '.$reservation->ID_RESERVA .' exitosamente']);
     }

     private function getCurrency($currency){

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

	public function destroy(Reserva $reserva)
	{
		$id=$reserva->ID_RESERVA;
		dd($id);
		$deleted = DB::delete('delete from reservas where reserva.id_reserva = ? and habitacion_reserva.id_reserva', [$id]);
	     return redirect()->route('reservas');
	}
}
