<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    function onLogin(Request $req){

    	$user = $req->input('user');
    	$pass = $req->input('pass');

    	$value = User::where('email','=',$user)->where('password','=',$pass)->count();
    	$name = User::where('email','=',$user)->pluck('name');

    	//dd($value);

    	if($value == 1){
    		$req->session()->put('user',$name);
    		return 1;
    	}else{
    		return 0;
    	}
    }

    function onLogOut(Request $request){

        $request->session()->flush();
        return redirect('/');
    }

	function register(){

		return view('register');
	}

	function userRegister(Request $req){

    	$name = $req->input('name');
    	$email = $req->input('email');
    	$pass = $req->input('pass');

    	$result = User::insert([
            'name'=>$name, 
            'email'=>$email,
            'password'=>$pass
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
}
