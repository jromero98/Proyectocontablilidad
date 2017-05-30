<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetalleFactura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('idFacturas');
            $table->string('tipo_factura',2);
            $table->integer('num_factura');
            $table->dateTime('fecha');
            $table->integer('doc_persona')->unsigned();
            $table->string('estado',12);
            $table->foreign('doc_persona')->references('doc_persona')->on('persona')
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
        Schema::dropIfExists('facturas');  
    }
}
