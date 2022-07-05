<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Roles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aquabe_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_business');
            $table->foreign('id_business')->references('id')->on('aquabe_business');
            $table->string('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aquabe_roles');
    }
}
