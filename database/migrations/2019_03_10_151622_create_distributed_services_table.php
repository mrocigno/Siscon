<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributedServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributed_services', function (Blueprint $table){
            $table->increments('id');
            $table->integer('service_id')->unsigned();
            $table->timestamp('distributed_date');
            $table->integer('user_id')->unsigned();
            $table->integer('sequence');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //dropando em services
    }
}
