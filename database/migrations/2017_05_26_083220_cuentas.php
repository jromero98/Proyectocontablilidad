<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cuentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->increments('idcuentas');
            $table->string('comprobante',45)->nullable();
            $table->double('valor', 15, 8)->nullable();
            $table->dateTime('fecha')->nullable();
            $table->integer('naturaleza')->nullable();
            $table->integer('cod_puc')->unsigned();
            $table->integer('id_aux')->unsigned();
            $table->integer('cod_descripcion')->unsigned();
            $table->string('idarticulo',5)->unsigned();
            $table->integer('idfactura')->unsigned();

            $table->foreign('cod_puc')->references('cod_puc')->on('puc')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_aux')->references('id_aux')->on('auxiliar')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cod_descripcion')->references('iddescripcion_cuenta')->on('descripcion_cuenta')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idarticulo')->references('idarticulos')->on('articulos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idfactura')->references('idfacturas')->on('facturas')
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
        Schema::dropIfExists('cuentas');  
    }
}
