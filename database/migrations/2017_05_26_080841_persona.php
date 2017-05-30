<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Persona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->integer('doc_persona')->unsigned();
            $table->string('nombre_persona',60)->nullable();
            $table->string('direccion',85)->nullable();
            $table->string('telefono',12)->nullable();
            $table->string('email',65)->nullable();
            $table->string('tipo',10)->nullable();
            $table->primary('doc_persona');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');  
    }
}
