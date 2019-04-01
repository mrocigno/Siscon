<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalizedServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finalized_services', function (Blueprint $table){
            $table->increments('id');
            $table->integer('distributed_service_id')->unsigned();
            $table->text("more_fields_json")->nullable();
            $table->text("observation")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('distributed_service_id')->references('id')->on('distributed_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('photos');
        Schema::drop('finalized_services');
    }
}
