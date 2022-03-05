<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmcrudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrmcrud', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',150);
            $table->string('email',190)->nullable();
            $table->string('mobile',150)->nullable();
            $table->date('dob')->nullable();
            $table->char('gender',1)->comments('M=> Male F=>Female');
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
        Schema::dropIfExists('hrmcrud');
    }
}
