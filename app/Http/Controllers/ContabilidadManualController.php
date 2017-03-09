<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;

class ContabilidadManualController extends Controller
{
    public function __construct(){        
    }
    
    public function index(){
        $cuentas = DB::table('puc')
        ->select('nom_puc', 'cod_puc')
        ->get();
        return view('contablidad_manual.create',["cuentas" => $cuentas]);  
    }
/*
    public function store(Request $request, Redirect $redirect)
    {
        $cuentas = Input::get('cuenta');
        $fechas = Input::get('fecha');
        $valores = Input::get('valor');
        $naturalezas = Input::get('naturaleza');

        $d = 0.0;
        $h = 0.0;

        for ($i=0; $i < count($cuentas); $i++) { 
            if(strcmp($naturalezas[$i], "debito") ){
                $h += (double)$valores[$i];
            }else{
                $d += (double)$valores[$i];
            }
        }
        if($d != $h ){
            $err = "Las cuentas T no están correctamente balanceadas. Hay un desbalance de: " . abs($d-$h);
            return redirect()->action('MovcontaMController@create')
            ->withErrors(['err', $err]);
        }
        for ($i=0; $i < count($cuentas); $i++) { 
            $cuent1 = new \App\CuentaT();
            $cuent1->cod_cuenta = $cuentas[$i];
            $cuent1->valor = $valores[$i];
            $cuent1->fecha = $fechas[$i];
            if(strcmp($naturalezas[$i], "debito") ){
                $cuent1->naturaleza = 0;
            }else{
                $cuent1->naturaleza = 1;
            }
            $cuent1->save();
            
        }
        

        return redirect()->action('BalanceController@index');
    }
    public function create(){
        $cuentas = \App\Cuenta::pluck('nombre', 'cod_cuenta');
        if(Input::has('err')){
            $err = Input::get('err');
             return view('conmanual')
                ->with('cuentas', $cuentas)
                ->with('err', $err);
        }else{
            return view('conmanual')
                ->with('cuentas', $cuentas);
        }
    }*/
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id){
        $movs = Conmanual::findOrFail($id);
       return view('movconmanual', compact('movs'));
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}