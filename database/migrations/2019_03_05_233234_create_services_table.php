<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table){
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->string('identifier', 30);
            $table->timestamp('date_received')->nullable();
            $table->integer('service_type_id')->unsigned();
            $table->string('address');
            $table->text('service_description')->nullable();
            $table->string('pg_guia', 10)->nullable();
            $table->string('calculated_pg_guia', 10)->nullable();
            $table->integer('delivery_id')->unsigned();
            $table->integer('applicant_id')->unsigned();
            $table->integer('polo_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('service_type_id')->references('id')->on('service_type');
            $table->foreign('delivery_id')->references('id')->on('delivery');
            $table->foreign('applicant_id')->references('id')->on('applicants');
            $table->foreign('polo_id')->references('id')->on('polos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('services');
    }
}
