<?php

namespace App\Http\Controllers;

use App\Models\EstadoHabitacion;
use Illuminate\Http\Request;

class EstadoHabitacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $estados = EstadoHabitacion::all();
        $title = 'Listado de estados';
        return view('estados.index', compact('estados','title'));
    }
    public function create(){
        $title = 'Definir Moneda';
        return view('estados.create',compact('title'));
    }
    public function details(EstadoHabitacion $estado){
	   // dd($currency);
        return view('estados.details',compact('estado'));
    }
    public function store(){
        $data = request()->all();
	   //dd($data);
        EstadoHabitacion::create([
            'DESCRIPCION'   => $data['description'],
        ]);
        return redirect()->route('estados');
    }
    public function update(EstadoHabitacion $estados){
	    $data = request()->all();
 	   	//dd($data);
		$estados->update([
               'DESCRIPCION' => $data['description'],
		]);
	    return redirect()->route('estados');
    }
}
