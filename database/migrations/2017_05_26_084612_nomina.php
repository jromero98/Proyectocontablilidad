<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Nomina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina', function (Blueprint $table) {
            $table->increments('idnomina');
            $table->date('fecha_nomina');
            $table->integer('empleados_ced_empleado')->unsigned();
            $table->string('diastrabajados',45)->nullable();
            $table->integer('salario')->nullable();
            $table->string('horased',45)->nullable();
            $table->string('horasen',45)->nullable();
            $table->string('bonificaciones',45)->nullable();
            $table->string('comisiones',45)->nullable();
            $table->string('auxtransportes',45)->nullable();
            $table->string('auxalimentos',45)->nullable();
            $table->string('aporteeps',45)->nullable();
            $table->string('aportepension',45)->nullable();
            $table->string('aportefondoempleados',45)->nullable();
            $table->string('libranza',45)->nullable();
            $table->string('embargos',45)->nullable();
            $table->string('retencionfuente',45)->nullable();
            $table->foreign('empleados_ced_empleado')->references('ced_empleado')->on('empleados')
                ->onUpdate('cascade')->onDelete('cascade');     
        });
      DB::unprepared("
          CREATE  OR REPLACE FUNCTION crearfc (IN idarticulo VARCHAR(5), IN idfactura INT, IN cantidad INT, IN precio_compra INT, IN precio_venta INT, IN precio INT) RETURNS integer AS $$
            BEGIN  INSERT INTO detalle_factura(idarticulo, idfactura, cantidad, precio_venta, precio_compra, prom) VALUES (idarticulo,idfactura,cantidad,precio_venta,precio_compra,precio); END;
            $$ LANGUAGE plpgsql;
        ");
      DB::unprepared("
          CREATE  OR REPLACE FUNCTION crearfv (IN idarticulo VARCHAR(5), IN idfactura INT, IN cantidad INT, IN precio_venta INT, IN descuento INT, IN precio INT) RETURNS integer AS $$
          BEGIN INSERT INTO detalle_factura(idarticulo, idfactura, cantidad, precio_venta, descuento, prom) VALUES (idarticulo,idfactura,cantidad,precio_venta,descuento,precio); END;
          $$ LANGUAGE plpgsql;
        ");
        DB::unprepared("
          CREATE  OR REPLACE FUNCTION cuentastotal (IN fecha DATE) RETURNS integer AS $$
            BEGIN SELECT fecha_nomina, sum(diastrabajados*salario/30)as Sueldos , sum(salario*1.25*horased/240+salario*1.55*horasen/240)as Horasextras, sum(auxtransportes) as axtrans, sum(auxalimentos) as axali,sum(bonificaciones)as Bonificaciones,sum(comisiones) as Comisiones, sum(aporteeps) as aporteseps, sum(aportepension) as aportespensiones, sum(aportefondoempleados)as fondoempleados, sum(libranza)as libranza, sum(embargos)as embargos, sum(retencionfuente) as retencion, sum((diastrabajados*(salario/30)+auxtransportes+bonificaciones+comisiones+auxalimentos+salario*1.25*horased/240+salario*1.55*horasen/240)-(aporteeps+aportepension+aportefondoempleados+libranza+embargos+retencionfuente)) as Total FROM nomina WHERE fecha_nomina=fecha GROUP by fecha_nomina; END;
            $$ LANGUAGE plpgsql;
        ");
        DB::unprepared("
          CREATE OR REPLACE FUNCTION totales (IN fecha DATE) RETURNS integer AS $$
           BEGIN SELECT sum(diastrabajados*(salario/30)+auxtransportes+auxalimentos+salario*1.25*horased/240+salario*1.55*horasEN/240+bonificaciones+comisiones) as Devengados,sum(aporteeps+aportepension+aportefondoempleados+libranza+embargos+retencionfuente) as Deducibles, sum((diastrabajados*(salario/30)+auxtransportes+auxalimentos+salario*1.25*horased/240+salario*1.55*horasen/240)-(aporteeps+aportepension+aportefondoempleados+libranza+embargos+retencionfuente)) as Total FROM nomina WHERE fecha_nomina=fecha  GROUP by fecha_nomina; END;
           $$ LANGUAGE plpgsql;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nomina');    
    }
}
