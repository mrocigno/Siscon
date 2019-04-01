<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table){
            $table->increments('id');
            $table->integer('finalized_service_id')->unsigned();
            $table->string('link', 255);
            $table->timestamps();
            $table->foreign('finalized_service_id')->references('id')->on('finalized_services');
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
