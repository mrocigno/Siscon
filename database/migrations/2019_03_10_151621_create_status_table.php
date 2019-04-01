<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status', function (Blueprint $table){
            $table->increments('id');
            $table->string('status');
            $table->text('description');
            $table->timestamps();
        });

        Schema::table('services', function (Blueprint $table){
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');
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
