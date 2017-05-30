<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Datosvivero extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datosvivero', function (Blueprint $table) {
            $table->increments('id_vivero');
            $table->string('nit_vivero',40);
            $table->string('nom_vivero',80)->nullable();
            $table->string('direccion_vivero',80)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datosvivero');
    }
}
