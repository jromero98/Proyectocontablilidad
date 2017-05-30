<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Articulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->string('idarticulos',5);
            $table->string('nom_articulo',45);
            $table->integer('categorias_idCategorias')->unsigned();
            $table->integer('stock')->nullable();
            $table->integer('maximo')->nullable();
            $table->integer('minimo')->nullable();
            $table->string('estado',12);
            $table->string('imagen',45);
            $table->integer('precio_venta');
            $table->primary('idarticulos');  
            $table->foreign('categorias_idcategorias')->references('idcategorias')->on('categorias')
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
        Schema::dropIfExists('articulos');  
    }
}
