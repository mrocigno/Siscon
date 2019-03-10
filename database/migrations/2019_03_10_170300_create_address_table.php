<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table){
            $table->increments('id');
            $table->text('address', 255)->nullable();
            $table->text('formatted_address', 255)->nullable();
            $table->text('reference_address', 255)->nullable();
            $table->string('neighborhood', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('zip_code', 9)->nullable();
            $table->timestamps();
        });
        Schema::table('services', function ($table){
            $table->foreign('address_id')->references('id')->on('address');
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
