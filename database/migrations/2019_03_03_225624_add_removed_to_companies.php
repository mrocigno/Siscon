<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemovedToCompanies extends Migration
{
    public function up()
    {
        Schema::table('companies', function($table){
            $table->boolean('removed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumn('removed');
    }
}
