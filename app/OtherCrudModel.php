<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherCrudModel extends Model
{
    public $table='othercrud';
	public $primaryKey='id';
	public $incrementing=true;
	public $keyType='int';
	public  $timestamps=false;

	public function BasicCrud()
    {
        return $this->belongsTo(BasicCrudModel::class,'basiccrud_id','id');
    }
}
