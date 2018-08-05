<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $currencies = Currency::all();
        $title = 'Listado de Monedas';
        return view('currencies.index', compact('currencies','title'));
    }
    public function create(){
        $title = 'Definir Moneda';
        return view('currencies.create',compact('title'));
    }
    public function details(Currency $currency){
	   // dd($currency);
        return view('currencies.details',compact('currency'));
    }
    public function store(request $request){
	    $this->validate($request,[
		    'description' => 'required',
		    'code' => 'required',
	    ]);
        $data = request()->all();
	   //dd($data);
        Currency::create([
            'CODIGO' => $data['code'],
            'DESCRIPCION'   => $data['description'],
        ]);
        return redirect()->route('currencies');
    }
    public function update(Currency $currency){
	    $data = request()->all();
 	   	//dd($data);
		$currency->update([
			'CODIGO' => $data['code'],
            'DESCRIPCION'   => $data['description'],
		]);
        return redirect()->route('currencies');
    }

    public function destroy(Currency $currency)
    {
	    try {
		    $currency->Delete();
		    return redirect('currencies');
	    } catch (\Illuminate\Database\QueryException $e) {
	    		$fallo='Error actualmente esta en uso';
			return redirect('currencies')->with('fallo', $fallo);
		}

    }
}
