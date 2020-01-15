<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Business extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aquabe_business', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut_user')->unique();
            $table->string('password');
            $table->string('firstname');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('position')->nullable();
            $table->string('phone');
            $table->timestamps();
        });

        Schema::create('aquabe_business_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_business');
            $table->foreign('id_business')->references('id')->on('aquabe_business');
            $table->string('rut_business')->unique();
            $table->string('business_name');
            $table->string('fantasy_name');
            $table->string('activity');
            $table->string('address');
            $table->string('comune');
            $table->string('city');
            $table->string('state');
            $table->string('phone');
            $table->string('logo');
            $table->string('entry'); // RUBRO
            $table->integer('employees');
            $table->string('rotation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aquabe_business');
        Schema::dropIfExists('aquabe_business_meta');
    }
}
