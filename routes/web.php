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
    Route::get('balance', 'BalanceController@index');
    Route::resource('contabilidad-manual','ContabilidadManualController');
});
//Entrust::routeNeedsPermission('contabilidad-manual','cuentas_manuales');
/*Route::filter('cuentas_manuales', function()
{
    // check the current user
    if (!Entrust::can('cuentas_manuales')) {
        App::abort(403);
    }else{
        
    }
});*/
