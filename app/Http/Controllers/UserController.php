<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $users = User::paginate(10);
        $title = 'Listado de Usuarios';

        return view('users.index',compact('users','title'));
    }
    public function create(){
        //dd(Hash::check('321','$2y$10$LNGTm9cmn.myiFd2.O9nE.q9KeZD2F8UFoWqVN50hUwBH9BuxqhOm'));
        return view('users.create');
    }

    public function details(User $user){
        return view('users.details',compact('user'));
    }
    public function store(){
        $data = request()->all();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        return redirect()->route('users');
    }

    public function update(User $user){
        $data = request()->all();
        //dd($data);
        $user->update([
            'name' => $data['name'],
            'email'   => $data['email'],
        ]);
        return redirect()->route('users');
    }

    public function changePassword(){
        $data = request()->all();
        $user = User::findOrFail($data['user']);
        if($data['newPassword']==$data['verifyPassword']){
            if(Hash::check($data['oldPassword'],$user->password)){
                $user->update([
                    'password' => bcrypt($data['newPassword'])
                ]);
                $title = 'Listado de Usuarios';
                $users = User::all();
                $message = 'Contraseña modificada correctamente';
                return view('users.index',compact('users','title','message'));
            }else{
                $error = 'La contraseña ingresada no coincide en los registros';
            }
        }else{
            $error = 'la nueva contraseña no coincide. Por Favor intente nuevamente';
        }
        return view('users.details',compact('user','error'));
    }

    public function destroy(User $user)
    {
        try {
            $user->Delete();
            return redirect('users');
        } catch (\Illuminate\Database\QueryException $e) {
            $fallo='No ha sido posible eliminar el usuario';
            return redirect('users')->with('fallo', $fallo);
        }

    }
}
