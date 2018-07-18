<?php

namespace App\Http\Controllers\Auth;


use Validator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>'showLoginForm'
        ]);
    }

    public function showLoginForm(){
        return view('login');
    }

    public function login(){

        $credentials =$this->validate(request(),[
            'email'     => 'email|required|string',
            'password'  => 'required|string',
        ]);
        if(Auth::attempt($credentials))
            return redirect()->route('welcome');

        return back()
            ->withErrors(['email'=>'credenciales no válidas'])
            ->withInput(request(['email']));
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
