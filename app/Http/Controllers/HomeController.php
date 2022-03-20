<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\BasicCrudModel;
use App\OtherCrudModel;
use App\Model\HrmCrudModel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function loginIndex(){

        $user = Session()->get('user');

       // dd($user);

		return view('login',compact('user'));
	}
    
	function HomeIndex(){

        return view('Home');
    }
}
