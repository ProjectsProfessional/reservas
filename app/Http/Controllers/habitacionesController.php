<?php

namespace App\Http\Controllers;

use App\Models\habitaciones;
use Illuminate\Http\Request;

class habitacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(){
	    $habitaciones = Habitaciones::all();
	    $title = 'Listado de Habitaciones';
	    return view('habitaciones.create', compact('habitaciones','title'));
    }
    public function create(){
	   $title = 'Cargar Media Controller';
	   return view('habitaciones.create',compact('title'));
    }
    public function details(habitaciones $habitaciones){
	   return view('habitaciones.details',compact('habitaciones'));
    }
}
