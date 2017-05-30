<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Facturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_factura', function (Blueprint $table) {
            $table->string('idarticulo',5);
            $table->integer('idfactura')->unsigned();
            $table->integer('cantidad');
            $table->integer('precio_compra');
            $table->integer('precio_venta');
            $table->integer('prom');
            $table->integer('descuento');
            $table->primary(['idarticulo','idfactura']);  
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
        Schema::dropIfExists('detalle_factura');  
    }
}
