<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\HrmCrudModel;
use Yajra\DataTables\DataTables;

class HrmCrudController extends Controller
{
    function hrmCrudIndex(){

    	return view('HRM.HrmCrudIndex');
    }

    public function hrmCrudData()
    {
        $hrmcruddata = HrmCrudModel::query()->where('company_id',$this->getCompanyId())
            ->orderBy('created_at','DESC')
            ->get();


        return DataTables::of($hrmcruddata)

            ->addColumn('action', function ($hrmcruddata) {

                return '<div class="btn-group btn-group-sm" role="group" aria-label="Action Button">
                    
                    <button data-rowid="'. $hrmcruddata->id . '"  type="button" href="#hrmCrud-document-upload" data-target="#hrmCrud-document-upload" data-toggle="modal" class="btn btn-info btn-file-upload btn-sm"><i class="fa fa-upload">Upload</i></button>
                    
                    <button data-remote="edit/' . $hrmcruddata->id . '" data-rowid="'. $hrmcruddata->id . '" 
                        data-name="'. $hrmcruddata->name . '" 
                        data-email="'. $hrmcruddata->email . '" 
                        data-dob="'. $hrmcruddata->dob . '" 
                        data-email="'. $hrmcruddata->email . '" 
                        type="button" href="#modal-edit-hrmcrud" data-target="#modal-edit-hrmcrud" data-toggle="modal" class="btn btn-sm btn-hrmcrud-edit btn-primary pull-center"><i class="fa fa-edit" >Edit</i></button>
                        
                     </div>
                    
                    ';
            })

            ->rawColumns(['action'])
            ->make(true);
    }

   
}
