<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Articulos;
use DB;

class BalanceController extends Controller
{
    public function index(Request $request){
        if ($request){
            $fecha=trim($request->get('fecha'));
            $cuenta=trim($request->get('cuenta'));
            $comprobante=trim($request->get('comprobante'));
            if(!empty($fecha) && !empty($cuenta) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza')
                ->where('fecha','=',$fecha)
                ->where('puc.cod_puc','=',$cuenta)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha) && !empty($cuenta)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza')
                ->where('fecha','=',$fecha)
                ->where('puc.cod_puc','=',$cuenta)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($cuenta) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza')
                ->where('puc.cod_puc','=',$cuenta)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza')
                ->where('fecha','=',$fecha)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza')
                ->where('fecha','=',$fecha)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if( !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza')
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if( !empty($cuenta)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza')
                ->where('puc.cod_puc','=',$cuenta)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else{
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza')
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }
            
            $puc = DB::table('puc')
                ->select('cod_puc','nom_puc','clase_puc')
                ->orderBy('cod_puc','asc')
                ->get();
            return view ('contabilidad_manual.show',['cuentas'=> $cuentas,'puc'=> $puc,"busqueda"=>$request]);
        }
    }

    public function kardex(Request $request){
        if ($request){
            $fecha=trim($request->get('fecha'));
            $cuenta=trim($request->get('cuenta'));
            $comprobante=trim($request->get('comprobante'));
            if(!empty($fecha) && !empty($cuenta) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza','idArticulo')
                ->where('fecha','=',$fecha)
                ->where('idArticulo','=',$cuenta)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha) && !empty($cuenta)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza','idArticulo')
                ->where('fecha','=',$fecha)
                ->where('idArticulo','=',$cuenta)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($cuenta) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza','idArticulo')
                ->where('idArticulo','=',$cuenta)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza','idArticulo')
                ->where('fecha','=',$fecha)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza','idArticulo')
                ->where('fecha','=',$fecha)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if( !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza','idArticulo')
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if( !empty($cuenta)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza','idArticulo')
                ->where('idArticulo','=',$cuenta)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else{
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','naturaleza','idArticulo')
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }
            
            $articulos=Articulos::get();
            return view ('contabilidad_manual.kardex',['cuentas'=> $cuentas,'articulos'=> $articulos,"busqueda"=>$request]);
        }
    }
}
