<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Articulos;
use App\Facturas;
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
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('fecha','=',$fecha)
                ->where('puc.cod_puc','=',$cuenta)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha) && !empty($cuenta)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('fecha','=',$fecha)
                ->where('puc.cod_puc','=',$cuenta)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($cuenta) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('puc.cod_puc','=',$cuenta)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('fecha','=',$fecha)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('fecha','=',$fecha)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if( !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if( !empty($cuenta)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('puc.cod_puc','=',$cuenta)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else{
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('idFactura','=',null)
                ->where('comprobante','!=',"Nomina")
                ->where('comprobante','!=',"Aporte")
                ->where('comprobante','!=',"Arqueo")
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
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza','idArticulo')
                ->where('fecha','=',$fecha)
                ->where('idArticulo','=',$cuenta)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->orderBy('comprobante', 'asc')
                ->get();
            }else if(!empty($fecha) && !empty($cuenta)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza','idArticulo')
                ->where('fecha','=',$fecha)
                ->where('idArticulo','=',$cuenta)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->orderBy('comprobante', 'asc')
                ->get();
            }else if(!empty($cuenta) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza','idArticulo')
                ->where('idArticulo','=',$cuenta)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->orderBy('comprobante', 'asc')
                ->get();
            }else if(!empty($fecha) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza','idArticulo')
                ->where('fecha','=',$fecha)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->orderBy('comprobante', 'asc')
                ->get();
            }else if(!empty($fecha)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza','idArticulo')
                ->where('fecha','=',$fecha)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->orderBy('comprobante', 'asc')
                ->get();
            }else if( !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza','idArticulo')
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->orderBy('comprobante', 'asc')
                ->get();
            }else if( !empty($cuenta)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza','idArticulo')
                ->where('idArticulo','=',$cuenta)
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->orderBy('comprobante', 'asc')
                ->get();
            }else{
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza','idArticulo')
                ->where('idFactura','!=',null)
                ->orderBy('fecha', 'asc')
                ->orderBy('comprobante', 'asc')
                ->get();
            }
            
            $articulos=Articulos::where("Estado","!=","Inactivo")->get();
            return view ('contabilidad_manual.kardex',['cuentas'=> $cuentas,'articulos'=> $articulos,"busqueda"=>$request]);
        }
    }
    public function kardexk(Request $request){
        if ($request){
            $arti=trim($request->get('articulo'));
            $facturas=Facturas::where("Estado","=","Pagado")->get();
            $articulos=Articulos::where('stock','>','0')
            ->where("Estado","!=","Inactivo")
            ->get();
            foreach ($articulos as $articulo) {
                foreach ($facturas as $factura) {
                    $detallesfactura=DB::table('facturas')
                            ->join('detalle_factura','idFactura','=','idFacturas')
                            ->select('idFacturas','Tipo_factura','Num_factura','idArticulo','cantidad','precio_compra','precio_venta','prom')
                            ->where('idFacturas',"=",$factura->idFacturas)->where("idArticulo","=",$articulo->idArticulos)
                            ->where('Estado',"=","Pagado")
                            ->get();
                    foreach ($detallesfactura as $detallefactura) {
                       if($articulo->stock!=0){
                        if($detallefactura->Tipo_factura=="Fv"){
                            $articulo->stock=$articulo->stock+$detallefactura->cantidad;
                       }else{
                            $articulo->stock=$articulo->stock-$detallefactura->cantidad;
                       }
                       }
                    }
                }
            }

        }
        return view ('contabilidad_manual.kardexk',['facturas'=>$facturas,'articulos'=>$articulos,"busqueda"=>$arti]);
    }
    public function balancenomina(Request $request){
        if ($request){
            $fecha=trim($request->get('fecha'));
            $cuenta=trim($request->get('cuenta'));
            $comprobante=trim($request->get('comprobante'));
            if(!empty($fecha) && !empty($cuenta) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('fecha','=',$fecha)
                ->where('puc.cod_puc','=',$cuenta)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha) && !empty($cuenta)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('fecha','=',$fecha)
                ->where('puc.cod_puc','=',$cuenta)                
                ->where('comprobante','=',"Nomina")
                ->orwhere('comprobante','=',"Aporte")
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($cuenta) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('puc.cod_puc','=',$cuenta)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('fecha','=',$fecha)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('fecha','=',$fecha)                
                ->where('comprobante','=',"Nomina")
                ->orwhere('comprobante','=',"Aporte")
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if( !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if( !empty($cuenta)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('puc.cod_puc','=',$cuenta)
                ->where('idFactura','=',null)
                ->where('comprobante','=',"Nomina")
                ->orwhere('comprobante','=',"Aporte")
                ->orderBy('fecha', 'asc')
                ->get();
            }else{
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }
            
            $puc = DB::table('puc')
                ->select('cod_puc','nom_puc','clase_puc')
                ->orderBy('cod_puc','asc')
                ->get();
            return view ('contabilidad_manual.shownomina',['cuentas'=> $cuentas,'puc'=> $puc,"busqueda"=>$request]);
        }
    }
    public function balancearqueos(Request $request){
        if ($request){
            $fecha=trim($request->get('fecha'));
            $cuenta=trim($request->get('cuenta'));
            $comprobante=trim($request->get('comprobante'));
            if(!empty($fecha) && !empty($cuenta) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('fecha','=',$fecha)
                ->where('puc.cod_puc','=',$cuenta)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha) && !empty($cuenta)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('fecha','=',$fecha)
                ->where('puc.cod_puc','=',$cuenta)
                ->where('comprobante','=',"Arqueo")
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($cuenta) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('puc.cod_puc','=',$cuenta)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha) && !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('fecha','=',$fecha)
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if(!empty($fecha)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('fecha','=',$fecha)
                ->where('idFactura','=',null)
                ->where('comprobante','=',"Arqueo")
                ->orderBy('fecha', 'asc')
                ->get();
            }else if( !empty($comprobante)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('comprobante','=',$comprobante)
                ->where('idFactura','=',null)
                ->orderBy('fecha', 'asc')
                ->get();
            }else if( !empty($cuenta)){
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('puc.cod_puc','=',$cuenta)
                ->where('idFactura','=',null)
                ->where('comprobante','=',"Arqueo")
                ->orderBy('fecha', 'asc')
                ->get();
            }else{
                $cuentas = DB::table('cuentas')->join('puc','puc.cod_puc',"=","cuentas.cod_puc")
                ->select('puc.cod_puc','nom_puc','comprobante','valor','fecha','cuentas.naturaleza')
                ->where('idFactura','=',null)
                ->where('comprobante','=',"Arqueo")
                ->orderBy('fecha', 'asc')
                ->get();
            }
            
            $puc = DB::table('puc')
                ->select('cod_puc','nom_puc','clase_puc')
                ->orderBy('cod_puc','asc')
                ->get();
            return view ('contabilidad_manual.showarqueos',['cuentas'=> $cuentas,'puc'=> $puc,"busqueda"=>$request]);
        }
    }
}
