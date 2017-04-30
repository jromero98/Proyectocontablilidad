<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', function () {
        return view('welcome');
    });

Route::group(['middleware' => 'auth'], function () {

	Route::get('/home', 'HomeController@index');

    Route::resource('/contabilidad-manual','ContabilidadManualController', ['middleware' => 'cuentas_manuales']);
    Route::get('/contabilidad-manual/factura/{id}','ContabilidadManualController@getFactura', ['middleware' => 'cuentas_manuales']);
    Route::get('/balance', 'BalanceController@index')->middleware('balance');
    Route::get('/balance-productos', 'BalanceController@kardex')->middleware('ver-kardex');
    Route::get('/kardex', 'BalanceController@kardexk')->middleware('ver-kardex');

    Route::resource('/puc','AdministrarPucController', ['middleware' => 'administrar-puc']);

    Route::post('/facturascompra','PagarCuentasController@pagarcompra')->middleware('facturar-compras');
    Route::get('/factura/{id}','HacerFactura@pdf')->middleware('facturar-compras');
    Route::resource('/compras','ComprasController', ['middleware' => 'facturar-compras']);

    Route::post('/facturasventa','PagarCuentasController@pagarventa')->middleware('facturar-ventas');
    Route::get('/facturas/{id}','HacerFactura@pdf2')->middleware('facturar-ventas');
    Route::resource('/ventas','VentasController', ['middleware' => 'facturar-ventas']);

    Route::resource('/almacen/articulo','ArticulosController', ['middleware' => 'articulo']);
    Route::resource('/almacen/categoria','CategoriasController', ['middleware' => 'categoria']);

    Route::resource('/perfil','PerfilController');

   Route::post('/persona','PersonaController@store'); 
   Route::get('/persona/index','PersonaController@index'); 
   Route::get('/persona/index','PersonaController@index'); 
});
