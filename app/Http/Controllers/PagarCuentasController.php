<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\ContabilidadManual;
use App\DetalleFactura;
use App\Facturas;
use DB;
use Log;

class PagarCuentasController extends Controller{
    
    public function pagarcompra(Request $request){
        $id=Input::get('id');
        /*$factura=Facturas::findOrFail($id);
        $factura->Estado='Pagado';
        $factura->update();*/
        $valores=Input::get('valor');
        $naturalezas=Input::get('naturaleza');
        error_log('*********');
        error_log('Hay tantos objetos: '.count($naturalezas));
        error_log('*********');
        $factura=Facturas::findOrFail($id);
        $total=DB::table('facturas')
                ->join('detalle_factura','idFactura','=','idFacturas')
                ->select('idFacturas','Num_factura','fecha','Estado',DB::raw('sum(cantidad*precio_compra) as total'))
                ->where('idFacturas',"=",$id)
                ->groupby('idFacturas','Num_factura','fecha','Estado')
                ->first();
        $detallesfactura=DB::table('facturas')
                ->join('detalle_factura','idFactura','=','idFacturas')
                ->select('idFacturas','Num_factura','idArticulo',DB::raw('(cantidad*precio_compra) as total'))
                ->where('idFacturas',"=",$id)->where('Tipo_factura',"=","Fc")
                ->get();
        for ($i=0; $i < count($valores); $i++) {
            foreach($detallesfactura as $detallefactura){
                $t=($valores[$i]*100)/$total->total;
                if($naturalezas[$i]==0){
                    PagarCuentasController::subircuentas(1105,'Fc'.$factura->Num_factura,($detallefactura->total*($t/100)),$id,$detallefactura->idArticulo,1);
                }else{
                    PagarCuentasController::subircuentas(2205,'Fc'.$factura->Num_factura,$detallefactura->total*($t/100),$id,$detallefactura->idArticulo,1);
                }
                if($i==1){
                     PagarCuentasController::subircuentas(14,'Fc'.$factura->Num_factura,$detallefactura->total-$detallefactura->total*0.19,$id,$detallefactura->idArticulo,0);
                
                    PagarCuentasController::subircuentas(2408,'Fc'.$factura->Num_factura,$detallefactura->total*0.19,$id,$detallefactura->idArticulo,0);
                }
            }
        }
        return Redirect::to('compras');
    }
    public function pagarventa(Request $request){
        $id=Input::get('id');
        $factura=Facturas::findOrFail($id);
        $factura->Estado='Pagado';
        $factura->update();
        $valores=Input::get('valor');
        $naturalezas=Input::get('naturaleza');
        $total=DB::table('facturas')
                ->join('detalle_factura','idFactura','=','idFacturas')
                ->select('idFacturas','Num_factura','fecha','Estado',DB::raw('sum(cantidad*precio_venta-descuento) as total'))
                ->where('idFacturas',"=",$id)
                ->groupby('idFacturas','Num_factura','fecha','Estado')
                ->first();
        $detallesfactura=DB::table('facturas')
                ->join('detalle_factura','idFactura','=','idFacturas')
                ->select('idFacturas','Num_factura','fecha','idArticulo','cantidad',DB::raw('(cantidad*precio_venta-descuento) as total'))
                ->where('idFacturas',"=",$id)
                ->get();
        $articulos=DB::table('articulos')
            ->join('detalle_factura','idArticulo',"=","idArticulos")
            ->join('facturas','idfacturas','=','idfactura')
            ->select(DB::raw('CONCAT(idArticulos, " ",nom_articulo) as articulo'),'idArticulos','stock',DB::raw('avg(precio_compra) as precio_promedio'))
            ->where('Tipo_factura',"=","Fc")
            ->where('stock','>','0')
            ->groupby('articulo','idArticulos','stock')->get();
        for ($i=0; $i < count($valores); $i++) {
            foreach($detallesfactura as $detallefactura){
                $t=($valores[$i]*100)/$total->total;
                if($naturalezas[$i]==0){
                    PagarCuentasController::subircuentas(1105,'Fv'.$factura->Num_factura,$detallesfactura->total*($t/100),$factura,$detallefactura->idArticulos,1);
                }else{
                    PagarCuentasController::subircuentas(1305,'Fv'.$factura->Num_factura,$detallesfactura->total*($t/100),$factura,$detallefactura->idArticulos,1);
                }
                if($i==0){
                    PagarCuentasController::subircuentas(4135,'Fv'.$factura->Num_factura,$detallefactura->total,$id,$detallefactura->idArticulo,1);
                
                    PagarCuentasController::subircuentas(2408,'Fv'.$factura->Num_factura,$detallefactura->total*0.19,$id,$detallefactura->idArticulo,1);
                    foreach($articulos as $articulo){
                        if($articulo->idArticulos==$detallefactura->idArticulos){
                            $valor=$detallefactura->cantidad*$articulo->precio_promedio-$detallefactura->cantidad*$articulo->precio_promedio*0.19;
                            PagarCuentasController::subircuentas(14,'Fv'.$factura->Num_factura,$valor,$id,$detallefactura->idArticulo,1);
                            PagarCuentasController::subircuentas(61,'Fv'.$factura->Num_factura,$valor,$id,$detallefactura->idArticulo,0);
                        }
                    }
                }
            }
        }
        return Redirect::to('ventas');
    }
    public function subircuentas($puc,$comprobante,$valor,$factura,$articulo,$naturaleza){
        $cuentas = new ContabilidadManual;
        $cuentas->cod_puc = $puc;
        $cuentas->comprobante = $comprobante;
        $cuentas->valor = $valor;
        $cuentas->fecha = date('Y-m-d');
        $cuentas->idFactura=$factura;
        $cuentas->idArticulo=$articulo;
        $cuentas->naturaleza = $naturaleza;
        $cuentas->cod_Descripcion = 0;
        $cuentas->save();
    }
}
