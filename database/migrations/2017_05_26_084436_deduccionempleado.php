<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Deduccionempleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deduccionempleado', function (Blueprint $table) {
            $table->integer('iddeduccionempleado');
            $table->integer('empleados_ced_empleado')->unsigned();
            $table->integer('valordeduccion')->nullable();
            $table->primary(['iddeduccionempleado','empleados_ced_empleado']);
            $table->foreign('empleados_ced_empleado')->references('ced_empleado')->on('empleados')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deduccionempleado'); 
    }
}
