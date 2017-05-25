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
            $table->integer('clase_puc');

            $table->foreign('clase_puc')->references('id')->on('clase_puc')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary('cod_puc');        
        });
        Schema::create('Auxiliar', function (Blueprint $table) {
            $table->increments('id_aux');
            $table->string('nom_aux',60);       
        });
        Schema::create('Descripcion_cuenta', function (Blueprint $table) {
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
        Schema::create('Datosvivero', function (Blueprint $table) {
            $table->increments('Id_vivero');
            $table->string('Nit_vivero',40);
            $table->string('Nom_vivero',80)->nullable();
            $table->string('Direccion_vivero',80)->nullable();
        });
        Schema::create('Categorias', function (Blueprint $table) {
            $table->increments('idCategorias');
            $table->string('Nombre_categoria',20);
            $table->string('Descripcion',45)->nullable();
            $table->string('Color',2);     
        });

        Schema::create('Articulos', function (Blueprint $table) {
            $table->string('idArticulos',5);
            $table->string('nom_articulo',45);
            $table->integer('Categorias_idCategorias');
            $table->integer('stock')->nullable();
            $table->integer('maximo')->nullable();
            $table->integer('minimo')->nullable();
            $table->string('Estado',12);
            $table->string('Imagen',45);
            $table->integer('Precio_venta');
            $table->primary('idArticulos');  
            $table->foreign('Categorias_idCategorias')->references('idCategorias')->on('Categorias')
                ->onUpdate('cascade')->onDelete('cascade');      
        });
        Schema::create('Persona', function (Blueprint $table) {
            $table->integer('doc_persona');
            $table->string('nombre_persona',60)->nullable();
            $table->string('direccion',85)->nullable();
            $table->string('telefono',12)->nullable();
            $table->string('email',65)->nullable();
            $table->primary('doc_persona');        
        });
        Schema::create('Facturas', function (Blueprint $table) {
            $table->increments('idFacturas');
            $table->string('Tipo_factura',2);
            $table->integer('Num_factura');
            $table->dateTime('fecha');
            $table->integer('doc_persona');
            $table->integer('Estado');
            $table->foreign('doc_persona')->references('doc_persona')->on('Persona')
                ->onUpdate('cascade')->onDelete('cascade');      
        });
        Schema::create('Detalle_Factura', function (Blueprint $table) {
            $table->string('idArticulo',5);
            $table->integer('idFactura');
            $table->integer('cantidad');
            $table->integer('precio_compra');
            $table->integer('precio_venta');
            $table->integer('prom');
            $table->integer('descuento');
            $table->primary(['idArticulo','idFactura']);  
            $table->foreign('idArticulo')->references('idArticulos')->on('Articulos')
                ->onUpdate('cascade')->onDelete('cascade');   
            $table->foreign('idFactura')->references('idFacturas')->on('Facturas')
                ->onUpdate('cascade')->onDelete('cascade');    
        });

        Schema::create('cuentas', function (Blueprint $table) {
            $table->increments('idcuentas');
            $table->string('comprobante',45)->nullable();
            $table->double('valor', 15, 8)->nullable();
            $table->dateTime('fecha')->nullable();
            $table->integer('naturaleza')->nullable();
            $table->integer('cod_puc');
            $table->integer('id_aux');
            $table->integer('cod_Descripcion');
            $table->string('idArticulo',5);
            $table->integer('idFactura');
            $table->foreign('cod_puc')->references('cod_puc')->on('puc')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_aux')->references('id_aux')->on('Auxiliar')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cod_Descripcion')->references('idDescripcion_cuenta')->on('Descripcion_cuenta')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idArticulo')->references('idArticulos')->on('Articulos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idFactura')->references('idFacturas')->on('Facturas')
                ->onUpdate('cascade')->onDelete('cascade');      
        });
        Schema::create('Cargos', function (Blueprint $table) {
            $table->increments('idCargos');
            $table->string('nombre_cargo',45);
            $table->string('riesgo',6)->nullable();
            $table->integer('salario_cargo')->nullable();
            $table->integer('color_cargo');    
        });

        Schema::create('Empleados', function (Blueprint $table) {
            $table->integer('ced_empleado');
            $table->string('nombre_empleado',45);
            $table->string('apellido_empleado',45);
            $table->string('dir_empleado',100);
            $table->string('tel_empleado',12);
            $table->string('email',45);
            $table->string('foto_empleado',95);
            $table->integer('Cargos_idCargos');
            $table->foreign('Cargos_idCargos')->references('idCargos')->on('Cargos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary('ced_empleado');        
        });

        Schema::create('deduccionempleado', function (Blueprint $table) {
            $table->integer('iddeduccionempleado');
            $table->integer('Empleados_ced_empleado');
            $table->integer('valordeduccion')->nullable();
            $table->primary(['iddeduccionempleado','Empleados_ced_empleado']);
            $table->foreign('Empleados_ced_empleado')->references('ced_empleado')->on('Empleados')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::create('Nomina', function (Blueprint $table) {
            $table->integer('idNomina');
            $table->date('Fecha_nomina');
            $table->integer('Empleados_ced_empleado');
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
            $table->foreign('Empleados_ced_empleado')->references('ced_empleado')->on('Empleados')
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
        Schema::dropIfExists('Auxiliar');
        Schema::dropIfExists('estadosresultados');
        Schema::dropIfExists('configsistema');
        Schema::dropIfExists('Datosvivero');
        Schema::dropIfExists('Categorias');  
        Schema::dropIfExists('Articulos');  
        Schema::dropIfExists('Persona');  
        Schema::dropIfExists('Facturas');  
        Schema::dropIfExists('Detalle_Factura');  
        Schema::dropIfExists('cuentas');  
        Schema::dropIfExists('Cargos');  
        Schema::dropIfExists('Empleados');  
        Schema::dropIfExists('deduccionempleado');  
        Schema::dropIfExists('Nomina');        
    }
}
