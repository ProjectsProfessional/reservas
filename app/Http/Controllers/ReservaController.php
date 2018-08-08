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
	  	   $reservas=DB::table('DBV_DETALLES_RESERVAS')->paginate(200);
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

     public function details(Reserva $reserva){

        $habitaciones = Reserva::find($reserva->ID_RESERVA)->rooms;
        return view('reservas.details',compact('reserva', 'habitaciones'));
     }

     public function store()
     {
         $data = request()->validate([
             'code'=>'required|unique:Reserva,CODIGO|max:5',
             'cliente'=>'required|numeric',
             'fuente'=>'required',
             'personas'=>'required|numeric',
             'fechaIngreso'=>'',
             'fechaSalida'=>'',
             'codigoVuelo'=>'',
             'habitaciones' =>'',
         ],[
             'code.required'=>'El Código de la reserva es obligatorio',
             'code.unique'=>'El código de Reserva ya ha sido ingresado al sistema',
             'code.max'=>'No es posible sobrepasar 5 Caracteres para el código de reserva',
             'cliente.required'=>'Es obligatorio ingresar el cliente de reserva',
             'code.digits'=>'El cliente ingresado no es válido',
             'fuente.required'=>'Es obligatorio ingresar la fuente de reserva',
             'personas.required'=>'Es obligatorio ingresar Las personas de reserva',
             'personas.digits'=>'Las personas deben ingresarse unicamente con números',
         ]);

         $reservation = new Reserva();
         $reservation->CODIGO = DB::select("SELECT DATE_FORMAT(NOW(),'%Y%m%d%H%i') AS code")[0]->code.'-'.$data["code"];
         $reservation->ID_CLIENTE = $data["cliente"];
         $reservation->ID_FUENTE = $data["fuente"];
         $reservation->ID_ESTADO_RESERVA = '1';
         $reservation->PERSONAS = $data["personas"];
         $reservation->FECHA_INGRESO = $data["fechaIngreso"];
         $reservation->FECHA_RETIRO = $data["fechaSalida"];
         $reservation->CODIGO_VUELO = $data["codigoVuelo"];
         DB::beginTransaction();
         $reservation->save();

         for ($i = 0; $i < count($data["habitaciones"]); $i++) {
             $detail = new habitacion_reserva();
             $detail->ID_HABITACION = $data["habitaciones"][$i]["habitacion"];
             $detail->ID_RESERVA = $reservation->ID_RESERVA;
             $detail->ID_MONEDA = $this->getCurrency($data["habitaciones"][$i]["moneda"]);
             $detail->PRECIO = $data["habitaciones"][$i]["precio"];
             $detail->save();

             DB::commit();
         }
         DB::rollBack();
         return response()->json(['message'=>'Se creado la reserva : '. $reservation->CODIGO .' exitosamente']);
     }

     private function getCurrency($currency){
        return DB::table('MONEDA')
            ->select('ID_MONEDA')
            ->where('CODIGO',$currency)
            ->first()->ID_MONEDA;
     }

     public function update(Reserva $reserva){
 	    $data = request()->only('codigoVuelo');
 		$reserva->update([
  		   'CODIGO_VUELO'   => $data['codigoVuelo'],
 		]);
 	    return redirect()->route('reservas');
     }

     public function pay(){
        $data = request()->all();
        $reserva = Reserva::findOrFail($data['reserva']);
        $reserva->update([
            'ID_ESTADO_RESERVA' => 2
        ]);
         return response()->json(['message'=>'Reserva : '.$reserva->CODIGO .' Pagada Exitosamente']);
     }

     public function cancel(){
         $data = request()->all();
         $reserva = Reserva::findOrFail($data['reserva']);
         DB::beginTransaction();
         DB::table('HABITACION_RESERVA')
             ->where('ID_RESERVA',$reserva->ID_RESERVA)
             ->delete();
         if($reserva->update([
             'ID_ESTADO_RESERVA' => 3
         ])){
             DB::commit();
             return response()->json(['message'=>'Se ha anulado la reserva : '.$reserva->CODIGO .'. Exitosamente']);
         }
         DB::rollBack();
     }

     public function destroy(Reserva $reserva)
     {
        $id=$reserva->ID_RESERVA;
        dd("Página en Mantenimiento, Conctacte con su administrador");
        $deleted = DB::delete('delete from reserva where reserva.id_reserva = ? and habitacion_reserva.id_reserva', [$id]);
        return redirect()->route('reservas');
     }

     public function available(){

     }
}
