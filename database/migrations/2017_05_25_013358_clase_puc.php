<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClasePuc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clase_puc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion',30)->nullable();        
        });
        Schema::create('puc', function (Blueprint $table) {
            $table->integer('cod_puc');
            $table->string('nom_puc',45);
            $table->integer('clase_puc')->unsigned();

            $table->foreign('clase_puc')->references('id')->on('clase_puc')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary('cod_puc');        
        });
        Schema::create('auxiliar', function (Blueprint $table) {
            $table->increments('id_aux');
            $table->string('nom_aux',60);       
        });
        Schema::create('descripcion_cuenta', function (Blueprint $table) {
            $table->increments('idDescripcion_cuenta');
            $table->string('Descripcion_cuenta',155)->nullable();       
        });
        Schema::create('estadosresultados', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechainicio')->nullable();        
            $table->date('fechafin')->nullable(); 
        });
        Schema::create('configsistema', function (Blueprint $table) {
            $table->increments('idconfigsistema');
            $table->integer('UVT')->nullable();        
            $table->integer('salariominimo')->nullable();    
        });
        Schema::create('datosvivero', function (Blueprint $table) {
            $table->increments('Id_vivero');
            $table->string('Nit_vivero',40);
            $table->string('Nom_vivero',80)->nullable();
            $table->string('Direccion_vivero',80)->nullable();
        });
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('idCategorias');
            $table->string('Nombre_categoria',20);
            $table->string('Descripcion',45)->nullable();
            $table->string('Color',2);     
        });

        Schema::create('articulos', function (Blueprint $table) {
            $table->string('idArticulos',5);
            $table->string('nom_articulo',45);
            $table->integer('Categorias_idCategorias')->unsigned();
            $table->integer('stock')->nullable();
            $table->integer('maximo')->nullable();
            $table->integer('minimo')->nullable();
            $table->string('Estado',12);
            $table->string('Imagen',45);
            $table->integer('Precio_venta');
            $table->primary('idArticulos');  
            $table->foreign('Categorias_idCategorias')->references('idCategorias')->on('categorias')
                ->onUpdate('cascade')->onDelete('cascade');      
        });
        Schema::create('persona', function (Blueprint $table) {
            $table->integer('doc_persona')->unsigned();
            $table->string('nombre_persona',60)->nullable();
            $table->string('direccion',85)->nullable();
            $table->string('telefono',12)->nullable();
            $table->string('email',65)->nullable();
            $table->primary('doc_persona');        
        });
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('idFacturas');
            $table->string('Tipo_factura',2);
            $table->integer('Num_factura');
            $table->dateTime('fecha');
            $table->integer('doc_persona')->unsigned();
            $table->integer('Estado');
            $table->foreign('doc_persona')->references('doc_persona')->on('persona')
                ->onUpdate('cascade')->onDelete('cascade');      
        });
        Schema::create('detalle_factura', function (Blueprint $table) {
            $table->string('idArticulo',5);
            $table->integer('idFactura')->unsigned();
            $table->integer('cantidad');
            $table->integer('precio_compra');
            $table->integer('precio_venta');
            $table->integer('prom');
            $table->integer('descuento');
            $table->primary(['idArticulo','idFactura']);  
            $table->foreign('idArticulo')->references('idArticulos')->on('articulos')
                ->onUpdate('cascade')->onDelete('cascade');   
            $table->foreign('idFactura')->references('idFacturas')->on('facturas')
                ->onUpdate('cascade')->onDelete('cascade');    
        });

        Schema::create('cuentas', function (Blueprint $table) {
            $table->increments('idcuentas');
            $table->string('comprobante',45)->nullable();
            $table->double('valor', 15, 8)->nullable();
            $table->dateTime('fecha')->nullable();
            $table->integer('naturaleza')->nullable();
            $table->integer('cod_puc')->unsigned();
            $table->integer('id_aux')->unsigned();
            $table->integer('cod_Descripcion')->unsigned();
            $table->string('idArticulo',5)->unsigned();
            $table->integer('idFactura')->unsigned();
            $table->foreign('cod_puc')->references('cod_puc')->on('puc')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_aux')->references('id_aux')->on('auxiliar')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cod_Descripcion')->references('idDescripcion_cuenta')->on('descripcion_cuenta')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idArticulo')->references('idArticulos')->on('articulos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idFactura')->references('idFacturas')->on('facturas')
                ->onUpdate('cascade')->onDelete('cascade');      
        });
        Schema::create('cargos', function (Blueprint $table) {
            $table->increments('idCargos');
            $table->string('nombre_cargo',45);
            $table->string('riesgo',6)->nullable();
            $table->integer('salario_cargo')->nullable();
            $table->integer('color_cargo');    
        });

        Schema::create('empleados', function (Blueprint $table) {
            $table->integer('ced_empleado');
            $table->string('nombre_empleado',45);
            $table->string('apellido_empleado',45);
            $table->string('dir_empleado',100);
            $table->string('tel_empleado',12);
            $table->string('email',45);
            $table->string('foto_empleado',95);
            $table->integer('Cargos_idCargos')->unsigned();
            $table->foreign('Cargos_idCargos')->references('idCargos')->on('cargos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary('ced_empleado');        
        });

        Schema::create('deduccionempleado', function (Blueprint $table) {
            $table->integer('iddeduccionempleado');
            $table->integer('Empleados_ced_empleado')->unsigned();
            $table->integer('valordeduccion')->nullable();
            $table->primary(['iddeduccionempleado','Empleados_ced_empleado']);
            $table->foreign('Empleados_ced_empleado')->references('ced_empleado')->on('empleados')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::create('nomina', function (Blueprint $table) {
            $table->integer('idNomina');
            $table->date('Fecha_nomina');
            $table->integer('Empleados_ced_empleado')->unsigned();
            $table->string('Diastrabajados',45)->nullable();
            $table->integer('Salario')->nullable();
            $table->string('HorasED',45)->nullable();
            $table->string('HorasEN',45)->nullable();
            $table->string('Bonificaciones',45)->nullable();
            $table->string('Comisiones',45)->nullable();
            $table->string('Auxtransportes',45)->nullable();
            $table->string('Auxalimentos',45)->nullable();
            $table->string('AporteEps',45)->nullable();
            $table->string('Aportepension',45)->nullable();
            $table->string('Aportefondoempleados',45)->nullable();
            $table->string('libranza',45)->nullable();
            $table->string('embargos',45)->nullable();
            $table->string('retencionfuente',45)->nullable();
            $table->foreign('Empleados_ced_empleado')->references('ced_empleado')->on('empleados')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary('idNomina');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clase_puc');
        Schema::dropIfExists('puc');
        Schema::dropIfExists('auxiliar');
        Schema::dropIfExists('estadosresultados');
        Schema::dropIfExists('configsistema');
        Schema::dropIfExists('datosvivero');
        Schema::dropIfExists('categorias');  
        Schema::dropIfExists('articulos');  
        Schema::dropIfExists('persona');  
        Schema::dropIfExists('facturas');  
        Schema::dropIfExists('detalle_factura');  
        Schema::dropIfExists('cuentas');  
        Schema::dropIfExists('cargos');  
        Schema::dropIfExists('empleados');  
        Schema::dropIfExists('deduccionempleado');  
        Schema::dropIfExists('nomina');        
    }
}
