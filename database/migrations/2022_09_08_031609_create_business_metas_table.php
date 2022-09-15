<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_metas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_business');
            $table->string('rut_business')->unique();
            $table->string('business_name');
            $table->string('fantasy_name');
            $table->string('activity');
            $table->string('address')->nullable();
            $table->string('comune')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('phone');
            $table->string('logo')->nullable();
            $table->string('entry')->comment('Este es el rubro')->nullable(); // RUBRO
            $table->integer('employees');
            $table->string('rotation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_metas');
    }
}
