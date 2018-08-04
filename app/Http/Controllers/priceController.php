<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Support\Facades\DB;
use App\Models\Impuesto;
use Illuminate\Support\Collection;
use App\Models\Currency;
use App\Models\price;
use App\Models\tipoHabitacion;
use Illuminate\Http\Request;

class priceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(){
	    $precios = price::all();
	    $currencies = DB::table('precio')
            ->join('moneda', 'precio.ID_MONEDA', '=', 'MONEDA.ID_MONEDA')
            ->select('MONEDA.CODIGO AS CODIGO', 'PRECIO.PRECIO', 'PRECIO.ID_PRECIO')
		  ->orderBy('PRECIO.ID_PRECIO')
            ->get();
	//	$currencies = Currency::all();
	    $title = 'Listado de Precios';
	    return view('precio.index', compact('precios','title', 'currencies'));
	}
	public function create(){
	    $title = 'Definir precio';
	    $impuestos=Impuesto::all();
		$currencies=Currency::all();
	    return view('price.create',compact('impuestos','currencies','title'));
	}
	public function details(price $price){
		$id=$price->ID_PRECIO;
	//	dd($id);
		$precios = DB::table('precio')
		   ->join('MONEDA', 'precio.ID_MONEDA', '=', 'MONEDA.ID_MONEDA')
		   ->join('IMPUESTO', 'IMPUESTO.ID_IMPUESTO', '=', 'PRECIO.ID_IMPUESTO')
		   ->where('PRECIO.ID_PRECIO', '=', $id)
		   ->select('MONEDA.CODIGO AS CODIGO', 'PRECIO.PRECIO AS PRECIO',
		    'PRECIO.ID_PRECIO', 'PRECIO.ID_MONEDA', 'PRECIO.ID_TIPO_HABITACION',
		    'PRECIO.ID_IMPUESTO', 'PRECIO.BRUTO', 'IMPUESTO.TASA AS TASA',
		    'PRECIO.PERSONAS AS PERSONAS')
		   ->get();
		   $impuestos=Impuesto::all();
		    $currencies=Currency::all();
		    $categorylist = Price::pluck('PRECIO','ID_PRECIO');
         return view('precio.details',compact('id', 'precios', 'impuestos', 'currencies', 'p'));
     }

     public function store(request $request){
	         $data = request()->all();
		    $ID_MONEDA = $request->input('moneda');
		    $precio = $request->input('price');
		    $ID_IMPUESTO= $request->input('impuesto');
		    $BRUTO= $request->input('grossTotal');
		    $push=[$ID_MONEDA,$precio,$ID_IMPUESTO,$BRUTO];
		    $collection = collect($push);
		    $collection->push($push);
		    $collection->all();
		    dd($collection);
         return redirect()->route('tiposHabitaciones');
     }
	public function update(Price $price){
	   $data = request()->all();
	    //dd($data);
	    $price->update([
		    'ID_MONEDA' => $data['moneda'],
              'PRECIO'   => $data['precio'],
		    'IMPUESTO' => $data['impuesto'],
	    ]);
	   return redirect()->route('tiposHabitaciones');
	}
	public function destroy(Request $request)
 	{
		$id=$request->id;
	//	dd($request->id);
		try{
    			 DB::table('PRECIO')->where('ID_PRECIO', '=', $id)->delete();
			 return response ()->json ('Eliminado');
  	    } catch (\Illuminate\Database\QueryException $e)
 	    {
		    $fallo='Error actualmente esta en uso';
  		}
     }
}
