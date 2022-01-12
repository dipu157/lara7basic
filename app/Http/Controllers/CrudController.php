<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BasicCrudModel;

class CrudController extends Controller
{
    function basicCrudIndex(){

    	return view('BasicCrud');
    }

    function AllBasicCrudData(){

        $basicCrudData = json_encode(BasicCrudModel::all());

  		return $basicCrudData;
    }

    function BasicCrudAdd(Request $req){

        $full_name = $req->input('full_name');
        $email = $req->input('email');
        $mobile = $req->input('mobile');
        $address = $req->input('address');


        $result = BasicCrudModel::insert([
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

    function BasicCrudDelete(Request $req){

    	$id = $req->input('id');
    	$result = BasicCrudModel::where('id','=',$id)->delete();
    	if($result == true){
    		return 1;
    	}else{
    		return 0;
    	}

    }

    function BasicCrudDetails(Request $req){

        $id = $req->input('id');
        $result = json_encode(BasicCrudModel::where('id','=',$id)->get());

        return $result;
    }

    function BasicCrudUpdate(Request $req){

        $id = $req->input('id');
        $name = $req->input('full_name');
        $email = $req->input('email');
        $mobile = $req->input('mobile');
        $address = $req->input('address');


        $result = BasicCrudModel::where('id','=',$id)->update([
        	'full_name'=>$name, 
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
