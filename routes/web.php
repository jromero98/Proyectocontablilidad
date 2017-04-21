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

Route::group(['middleware' => 'guest'], function () {
	Route::get('/', function () {
    	return view('welcome');
	});
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index');
    Route::get('/balance', 'BalanceController@index')->middleware('balance');
    Route::resource('/contabilidad-manual','ContabilidadManualController', ['middleware' => 'cuentas_manuales']);
    Route::get('/contabilidad-manual/factura/{id}','ContabilidadManualController@getFactura', ['middleware' => 'cuentas_manuales']);
    Route::resource('/puc','AdministrarPucController');
    Route::get('/factura/{id}','HacerFactura@pdf');
    Route::get('/facturas/{id}','HacerFactura@pdf2');
    Route::post('/facturascompra','PagarCuentasController@pagarcompra');
    Route::post('/facturasventa','PagarCuentasController@pagarventa');
    Route::resource('/compras','ComprasController');
    Route::resource('/ventas','VentasController');
    Route::resource('/almacen/articulo','ArticulosController');
    Route::resource('/almacen/categoria','CategoriasController');
});
