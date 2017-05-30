<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Puc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puc', function (Blueprint $table) {
            $table->integer('cod_puc');
            $table->string('nom_puc',45);
            $table->string('naturaleza',2);
            $table->integer('clase_puc')->unsigned();

            $table->foreign('clase_puc')->references('id')->on('clase_puc')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->primary('cod_puc');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puc');
    }
}
