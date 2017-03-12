<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;
use App\ContabilidadManual;
use App\Descripcion_Cuenta;

class ContabilidadManualController extends Controller
{
    public function __construct(){        
    }
    
    public function index(){
        $cuentas = DB::table('puc')
        ->select('nom_puc', 'cod_puc')
        ->get();
        return view('contabilidad_manual.create',["cuentas" => $cuentas]);  
    }

    public function store(Request $request, Redirect $redirect)
    {
        $cuentas = Input::get('cuenta');
        $comprobante = Input::get('nodoc');
        $valores = Input::get('valor');
        $fecha = Input::get('fecha');
        $naturalezas = Input::get('naturaleza');
        $desc=Input::get('desc');

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
            $err = "Las cuentas T no están correctamente balanceadas. Hay un desbalance de: $" . abs($d-$h);
            return redirect()->action('ContabilidadManualController@index')
            ->withErrors(['Error', $err]);
        }
        for ($i=0; $i < count($cuentas); $i++) { 
            $cuenta = new ContabilidadManual;
            $cuenta->cod_puc = $cuentas[$i];
            $cuenta->comprobante = $comprobante;
            $cuenta->valor = $valores[$i];
            $cuenta->fecha = $fecha;
            if(strcmp($naturalezas[$i], "debito") ){
                $cuenta->naturaleza = 0;
            }else{
                $cuenta->naturaleza = 1;
            }
            $cuenta->save();
            
        }
        return redirect()->action('BalanceController@index');
    }
}