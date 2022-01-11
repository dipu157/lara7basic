<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CrudModel;

class CrudController extends Controller
{
    function crudIndex(){

    	return view('CrudIndex');
    }

    function crudAdd(Request $req){

        $full_name = $req->input('full_name');
        $email = $req->input('email');
        $mobile = $req->input('mobile');
        $address = $req->input('address');


        $result = CrudModel::insert([
            'full_name'=>$full_name, 
            'email'=>$email,
            'mobile'=>$mobile,
            'address'=>$address
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
}
