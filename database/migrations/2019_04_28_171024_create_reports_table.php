<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('reports', function (Blueprint $table){
            $table->increments('id');
            $table->integer('service_type_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->text('fields_json');
            $table->timestamps();

            $table->foreign('service_type_id')->references('id')->on('service_type');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unique(['service_type_id', 'company_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('reports');
    }
}
