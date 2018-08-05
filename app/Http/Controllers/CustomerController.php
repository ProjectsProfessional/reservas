<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(){
    	    $client = Client::paginate(200);
    	    $title = 'Listado de Clientes';
    	    return view('clients.index', compact('client','title'));
    	}
    	public function create(){
    	    $title = 'Crear Cliente';
    	    $paises = DB::table('PAIS')->pluck('PAIS','ID_PAIS');
    	    return view('clients.create',compact('title','paises'));
    	}
    	public function details(Client $client){
            $paises = Country::all();
            $pais = $paises->find($client->ID_PAIS);
            $paises = DB::table('PAIS')->pluck('PAIS','ID_PAIS');
            $pais = $pais->PAIS;
            return view('clients.details',compact('client','paises','pais'));
         }

	 public function update(Client $client){
		 $data = request()->all();
		 // dd($data);
		  $client->update([
			  'CODIGO' => $data['codigo'],
			  'ID_PAIS' => $data['pais'],
			  'NOMBRE1'  => $data['nombre'],
			  'NOMBRE2'  => $data['segundoNombre'],
			  'APELLIDO1'  => $data['primerApellido'],
			  'APELLIDO2'  => $data['segundoApellido'],
			  'TELEFONO'  => $data['telefono'],
			  'EMAIL'  => $data['email'],
			  'TIPO_CLIENTE'  => $data['tipoCliente'],
			  'COMENTARIOS'  => $data['comentarios'],
			  'PATH_SCAN'  => $data['pathScan'],
		  ]);
		 return redirect()->route('clients');
	 }

    public function isPreferentialCustomer(){
        $data = request()->all();
        $customer = DB::table('CLIENTE')
            ->select('TIPO_CLIENTE')
            ->where('ID_ClIENTE',$data['customer'])
            ->first();

        if ($customer->TIPO_CLIENTE == 'PREF')
            return response()->json(['message'=>true]);

        return response()->json(['message'=>false]);
    }

     public function store(){

        $validator = Validator::make(request()->all(),[
            'nombre'=>'required|string',
            'primerApellido'=>'required|string',
            'pais'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->route('clients.create')
                ->withErrors([
                    'pais'=>'País No Válido',
                    'nombre'=>'El nombre es obligatorio',
                    'primerApellido'=>'El apellido es obligatorio'
                ])
                ->withInput(request(['pais']));
        }

        $data = request()->all();
        $lastCustomer = DB::table('CLIENTE')->select(DB::raw('COUNT(1) AS Increment'))->first();

        Client::create([
        'CODIGO' => substr($data['nombre'],0,1).$data['primerApellido'].$lastCustomer->Increment,
        'ID_PAIS' => $data['pais'],
        'NOMBRE1'  => $data['nombre'],
        'NOMBRE2'  => $data['segundoNombre'],
        'APELLIDO1'  => $data['primerApellido'],
        'APELLIDO2'  => $data['segundoApellido'],
        'TELEFONO'  => $data['telefono'],
        'EMAIL'  => $data['email'],
        'TIPO_CLIENTE'  => $data['tipoCliente'],
        'COMENTARIOS'  => $data['comentarios'],
        'PATH_SCAN'  => $data['pathScan'],
        ]);
        return redirect()->route('clients');
     }
	public function destroy(Client $client)
	{
		try{
			$client->Delete();
			return redirect()->route('clients');
	    } catch (\Illuminate\Database\QueryException $e)
	    {
			$fallo='Error actualmente esta en uso';
			return redirect('clients')->with('fallo', $fallo);
		}
	}
}
