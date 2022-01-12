<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BasicCrudTable extends Migration
{
   
    public function up()
    {
        Schema::create('basiccrud', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name',150);
            $table->string('email',190)->nullable();
            $table->string('mobile',150)->nullable();
            $table->string('address',150)->nullable();
        });
    }


    public function down()
    {
        //
    }
}
