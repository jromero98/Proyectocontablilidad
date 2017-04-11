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
        $auxiliar = DB::table('auxiliar')
        ->select('nom_aux', 'id_aux')
        ->get();
        return view('contabilidad_manual.create',["cuentas" => $cuentas,"auxiliar"=>$auxiliar]);  
    }

    public function store(Request $request, Redirect $redirect)
    {        
        $cuenta = Input::get('cuenta');
        $comprobante = Input::get('nodoc');
        $valores = Input::get('valor');
        for($i=0;$i<count($valores);$i++){
            $valores[$i]=str_replace(",", "", $valores[$i]);
        }
        $string = Input::get('fecha');
        $auxiliar = Input::get('auxil');
        $token = strtok($string, " ");
        $cont=0;
        $fh;
        while ($token !== false){
            if ($cont==0) {
                $fh =$token;
            }if ($cont==1) {
                $fecha=$token.":00";
            }
            $cont++;
            $token = strtok(" ");
        } 
        
        $naturalezas = Input::get('naturaleza');
        $desc=Input::get('desc');

        $d = 0.0;
        $h = 0.0;

        for ($i=0; $i < count($cuenta); $i++) { 
            if(strcmp($naturalezas[$i], "debito") ){
                $h += (double)$valores[$i];
            }else{
                $d += (double)$valores[$i];
            }
        }
        if($d != $h ){
            $cuentas = DB::table('puc')
            ->select('nom_puc', 'cod_puc')
            ->get();
            $auxiliares = DB::table('auxiliar')
            ->select('nom_aux', 'id_aux')
            ->get();
            for($i=0;$i<count($valores);$i++){
            $valores[$i]=number_format($valores[$i]);
            }
            $err = "Las cuentas T no están correctamente balanceadas. Hay un desbalance de: $" . number_format(abs($d-$h));
            return view('contabilidad_manual.create')
            ->with("cuent",$cuenta)->with("naturalezas",$naturalezas)->with("cuentas",$cuentas)->with("valores",$valores)
            ->with("auxiliar",$auxiliares)->with("auxiliarr",$auxiliar)->with("comprobante",$comprobante)->with("descripcion",$desc)
            ->with("fecha",$string)
            ->withErrors($err)
            ;
        }
        for ($i=0; $i < count($cuenta); $i++) {
            $cuentas = new ContabilidadManual;
            $cuentas->cod_puc = $cuenta[$i];
            $cuentas->comprobante = $comprobante;
            $cuentas->valor = $valores[$i];
            $cuentas->id_aux = $auxiliar[$i];
            $cuentas->fecha = $fh." ".$fecha;
            if(strcmp($naturalezas[$i], "debito") ){
                $cuentas->naturaleza = 0;
            }else{
                $cuentas->naturaleza = 1;
            }
            $cuentas->save();
            
        }
        return redirect()->action('BalanceController@index');
    }
}