<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BasicCrudModel;
use App\OtherCrudModel;

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

    function otherCrudIndex(){

        $BasicCrud = BasicCrudModel::query()->pluck('full_name','id');

       // dd($BasicCrud);

    	return view('OtherCrud',compact('BasicCrud'));
    }

    function AllOtherCrudData(){

        $otherCrudData = json_encode(OtherCrudModel::with('BasicCrud')->get());

        //dd($otherCrudData);

  		return $otherCrudData;
    }

    function OtherCrudDelete(Request $req){

    	$id = $req->input('id');
    	$result = OtherCrudModel::where('id','=',$id)->delete();
    	if($result == true){
    		return 1;
    	}else{
    		return 0;
    	}

    }

    function photoUpload(Request $request){

        $id = $request->id;
        //dd($id);
        $photoPath = $request->file('photo')->store('public'); 
        $photoName = (explode('/',$photoPath))[1];
        $host = $_SERVER['HTTP_HOST'];
        $location = "http://localhost/lara7basic/storage/app/public/".$photoName;
 
        $result = OtherCrudModel::where('id','=',$id)->update(['photo'=>$location]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }
     }

     function OtherCrudAdd(Request $req){

        $username = $req->input('username');
        $gender = $req->input('gender');
        $speciality = $req->input('speciality');


        $result = OtherCrudModel::insert([
            'basiccrud_id'=>$username, 
            'gender'=>$gender,
            'speciality'=>$speciality
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
}
