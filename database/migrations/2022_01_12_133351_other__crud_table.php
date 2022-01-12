<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OtherCrudTable extends Migration
{
    public function up()
    {
        Schema::create('othercrud', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('basiccrud_id')->unsigned()->nullable();
            $table->foreign('basiccrud_id')->references('id')->on('basiccrud');
            $table->char('gender',1);
            $table->string('speciality',255)->nullable();
            $table->date('dob')->nullable();
            $table->string('photo',150)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
