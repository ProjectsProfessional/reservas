<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\price;
use Illuminate\Http\Request;

class priceController extends Controller
{
	public function index(){
	    $precios = price::all();
	    $title = 'Listado de Precios';
	    return view('precio.index', compact('precios','title'));
	}
	public function create(){
	    $currencies=Currency::all();
	    $title = 'Definir precio';
	    return view('precio.create',compact('currencies','title'));
	}
	public function details(price $precio){
         return view('precio.details',compact('precio'));
     }

     public function store(){
         $data = request()->all();
         price::create([
             'ID_MONEDA' => $data['moneda'],
             'PRECIO'   => $data['description'],
         ]);
         return redirect()->route('precio');
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
