<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicCrudModel extends Model
{
    public $table='basiccrud';
	public $primaryKey='id';
	public $incrementing=true;
	public $keyType='int';
	public  $timestamps=false;
}
