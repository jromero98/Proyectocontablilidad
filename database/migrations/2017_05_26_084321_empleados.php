<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Empleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->integer('ced_empleado');
            $table->string('nombre_empleado',45);
            $table->string('apellido_empleado',45);
            $table->string('dir_empleado',100);
            $table->string('tel_empleado',12);
            $table->string('email',45);
            $table->string('foto_empleado',95);
            $table->integer('cargos_idcargos')->unsigned();
            $table->foreign('cargos_idcargos')->references('idcargos')->on('cargos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary('ced_empleado');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');  
    }
}
