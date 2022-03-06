<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HrmCrudModel extends Model
{
    public $table='hrmcrud';

	protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'dob',
        'gender',        
        'photo',
        'status',
    ];
}
