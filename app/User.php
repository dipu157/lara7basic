<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public $table='users';

	protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
