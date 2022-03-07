<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\HrmCrudModel;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HrmCrudController extends Controller
{
    function hrmCrudIndex(){

    	return view('HRM.HrmCrudIndex');
    }

    public function hrmCrudData()
    {
        $hrmcruddata = HrmCrudModel::query()->where('status',true)
            ->orderBy('created_at','DESC')
            ->get();


        return DataTables::of($hrmcruddata)

            ->addColumn('action', function ($hrmcruddata) {

                return '<div class="btn-group btn-group-sm" role="group" aria-label="Action Button">
                    
                    <button data-rowid="'. $hrmcruddata->id . '"  type="button" href="#hrmCrud-photo-upload" 
                    data-target="#hrmCrud-photo-upload" data-toggle="modal" class="btn btn-info btn-photo btn-sm">
                    <i class="fa fa-upload">Upload</i></button>
                    
                    <button data-remote="edit/' . $hrmcruddata->id . '" data-rowid="'. $hrmcruddata->id . '" 
                        data-name="'. $hrmcruddata->name . '" 
                        data-email="'. $hrmcruddata->email . '"
                        data-mobile="'. $hrmcruddata->mobile . '"
                        data-dob = "'. $hrmcruddata->dob . '"
                        data-gender = "'. $hrmcruddata->gender . '"
                        type="button" href="#modal-edit-hrmcrud" data-target="#modal-edit-hrmcrud" 
                        data-toggle="modal" class="btn btn-sm btn-hrmcrud-edit btn-primary 
                        pull-center"><i class="fa fa-edit" >Edit</i></button>

                    <button data-rowid="'. $hrmcruddata->id . '"  type="button" href="#hrmCrud-delete" 
                    data-target="#hrmCrud-delete" data-toggle="modal" class="btn btn-danger btn-hrmcrud-delete 
                    btn-sm"><i class="fa fa-trash">Delete</i></button>
                     </div>
                    
                    ';
            })

            ->editColumn('photo', function ($hrmcruddata) {
                if (!isset($hrmcruddata->photo)) {
                    return "Photo";
                }
                return '<img src="' . asset($hrmcruddata->photo) .
                    '" alt=" " style="height: 50px; width: 50px;" >';
            })

            ->rawColumns(['action','photo'])
            ->make(true);
    }

    public function create(Request $request)
    {

//        dd($request);

        $request['dob'] = Carbon::createFromFormat('d-m-Y',$request['dob'])->format('Y-m-d');

        DB::beginTransaction();

        try {

            HrmCrudModel::query()->create($request->all());


        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();

        return response()->json(['success' => 'New Data Added'], 200);
    }

    
    public function updateImage(Request $request)
    {
        DB::beginTransaction();

        try {

            $card_no = HrmCrudModel::query()->where('id',$request['hrmPhoto_id'])->first();

            if($request->hasfile('photo-image'))
            {
                
                $file = $request->file('photo-image');
                $name = $card_no->name.'-'.$card_no->id.'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/photo/', $name);

                HrmCrudModel::query()->find($request['hrmPhoto_id'])->update(['photo'=>'photo/'.$name]);
            }

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();

        return redirect()->action('HrmCrudController@hrmCrudIndex')->with('success','Successful');

    }

    
    public function update(Request $request)
    {

        DB::beginTransaction();

        try {
            
            $request['dob'] = Carbon::createFromFormat('Y-m-d',$request['dob'])->format('Y-m-d');
            

            HrmCrudModel::find($request['id'])->update($request->except('_token','id'));

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();

        return redirect()->action('HrmCrudController@hrmCrudIndex')->with('success',trans('message.success'));
    }

    public function Delete(Request $request){

        DB::beginTransaction();

        try {

            $id = $request['id'];
            
            HrmCrudModel::where('id',$id)->delete();

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();

        return redirect()->action('HrmCrudController@hrmCrudIndex')->with('success',trans('message.success'));
    
    }

   
}
