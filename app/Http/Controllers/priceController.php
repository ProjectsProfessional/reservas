<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Impuesto;
use Illuminate\Support\Collection;
use App\Models\Currency;
use App\Models\price;
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
	    return view('precio.create',compact('impuestos','currencies','title'));
	}
	public function details(price $precio){
		$id=$precio->ID_PRECIO;
		$currencies = DB::table('precio')
		   ->join('moneda', 'precio.ID_MONEDA', '=', 'MONEDA.ID_MONEDA')
		   ->where('PRECIO.ID_PRECIO', '=', $id)
		   ->select('MONEDA.CODIGO AS CODIGO', 'PRECIO.PRECIO', 'PRECIO.ID_PRECIO')
		   ->get();
         return view('precio.details',compact('id', 'currencies'));
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
	public function update(Price $precio){
	   $data = request()->all();
	    //dd($data);
	    $precio->update([
		    'ID_MONEDA' => $data['code'],
              'PRECIO'   => $data['precio'],
	    ]);
	   return redirect()->route('precio');
	}
}
