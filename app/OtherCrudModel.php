<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherCrudModel extends Model
{
    public $table='othercrud';

	protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'basiccrud_id',
        'gender',
        'speciality',
        'dob',
        'photo',
        'status',
    ];

	public function BasicCrud()
    {
        return $this->belongsTo(BasicCrudModel::class,'basiccrud_id','id');
    }
}
