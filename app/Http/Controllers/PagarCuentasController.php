<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\ContabilidadManual;
use App\DetalleFactura;
use App\Facturas;
use DB;

class PagarCuentasController extends Controller{
    
    public function pagarcompra(Request $request){
        $id=Input::get('id');
        $factura=Facturas::findOrFail($id);
        $factura->Estado='Pagado';
        $factura->update();
        $valores=Input::get('valor');
        $naturalezas=Input::get('naturaleza');
        echo count($request->get('valor'));
        echo "<br>".count($valores);
        $facturas=DB::table('facturas')
                ->join('detalle_factura','idFactura','=','idFacturas')
                ->select('idFacturas','Num_factura','fecha','Estado',DB::raw('(cantidad*precio_compra) as total'))
                ->where('idFacturas',"=",$id)
                ->first();
        $detallesfactura=DetalleFactura::where('idFactura','=',$id)->get();
        for ($i=0; $i < count($valores); $i++) {
            foreach($detallesfactura as $detallefactura){
                $cuentas = new ContabilidadManual;
                if($naturalezas[$i]==0){
                    $cuentas->cod_puc = 1105;
                }else{
                    $cuentas->cod_puc = 2205;
                }
                $cuentas->comprobante = 'Fc'.$factura->Num_factura;
                $cuentas->valor = $valores[$i];
                $cuentas->fecha = date('Y-m-d');
                $cuentas->idFactura=$id;
                $cuentas->idArticulo=$detallefactura->idArticulo;
                $cuentas->naturaleza = 1;
                $cuentas->cod_Descripcion = 0;
                $cuentas->save();
            }
            if(!empty($detallesfactura)){
                $cuentas = new ContabilidadManual;
                $cuentas->cod_puc = 14;
                $cuentas->comprobante = 'Fc'.$factura->Num_factura;
                $cuentas->valor = $valores[$i]-$valores[$i]*0.19;
                $cuentas->fecha = date('Y-m-d');
                $cuentas->idFactura=$id;
                $cuentas->idArticulo=$detallefactura->idArticulo;
                $cuentas->naturaleza = 0;
                $cuentas->cod_Descripcion = 0;
                $cuentas->save();
                $cuentas = new ContabilidadManual;
                $cuentas->cod_puc = 2408;
                $cuentas->comprobante = 'Fc'.$factura->Num_factura;
                $cuentas->valor = $valores[$i]*0.19;
                $cuentas->fecha = date('Y-m-d');
                $cuentas->idFactura=$id;
                $cuentas->idArticulo=$detallefactura->idArticulo;
                $cuentas->naturaleza = 0;
                $cuentas->cod_Descripcion = 0;
                $cuentas->save();
            }
        }
        return Redirect::to('ventas');
    }
    public function pagarventa(Request $request){
        $id=Input::get('id');
        $factura=Facturas::findOrFail($id);
        $factura->Estado='Pagado';
        $factura->update();
        $valores=Input::get('valor');
        $naturalezas=Input::get('naturaleza');
        $detallesfactura=DetalleFactura::where('idFactura','=',$id)->get();
        $facturas=DB::table('facturas')
                ->join('detalle_factura','idFactura','=','idFacturas')
                ->select('idFacturas','Num_factura','fecha','Estado',DB::raw('(cantidad*precio_venta-descuento) as total'))
                ->where('idFacturas',"=",$id)
                ->first();
        echo count($request->get('valor'));
        echo "<br>".count($valores);
        for ($i=0; $i < count($valores); $i++) {
            foreach($detallesfactura as $detallefactura){
                $cuentas = new ContabilidadManual;
                if($naturalezas[$i]==0){
                    $cuentas->cod_puc = 1105;
                }else{
                    $cuentas->cod_puc = 1305;
                }

                $cuentas->comprobante = 'Fv'.$factura->Num_factura;
                $cuentas->valor = $facturas->total+$facturas->total*0.19;
                $cuentas->fecha = date('Y-m-d');
                $cuentas->idFactura=$id;
                $cuentas->idArticulo=$detallefactura->idArticulo;
                $cuentas->naturaleza = 0;
                $cuentas->cod_Descripcion = 0;
                $cuentas->save();
                
                $cuentas = new ContabilidadManual;
                $cuentas->cod_puc = 4135;
                $cuentas->comprobante = 'Fv'.$factura->Num_factura;
                $cuentas->valor = $facturas->total;
                $cuentas->fecha = date('Y-m-d');
                $cuentas->idFactura=$id;
                $cuentas->idArticulo=$detallefactura->idArticulo;
                $cuentas->naturaleza = 1;
                $cuentas->cod_Descripcion = 0;
                $cuentas->save();
                
                $cuentas = new ContabilidadManual;
                $cuentas->cod_puc = 2408;
                $cuentas->comprobante = 'Fv'.$factura->Num_factura;
                $cuentas->valor = $facturas->total*0.19;
                $cuentas->fecha = date('Y-m-d');
                $cuentas->idFactura=$id;
                $cuentas->idArticulo=$detallefactura->idArticulo;
                $cuentas->naturaleza = 1;
                $cuentas->cod_Descripcion = 0;
                $cuentas->save();
            }
            
            if(!empty($detallesfactura)){
                $cuentas = new ContabilidadManual;
                $cuentas->cod_puc = 14;
                $cuentas->comprobante = 'Fv'.$factura->Num_factura;
                $cuentas->valor = $valores[$i]-$valores[$i]*0.19;
                $cuentas->fecha = date('Y-m-d');
                $cuentas->idFactura=$id;
                $cuentas->idArticulo=$detallefactura->idArticulo;
                $cuentas->naturaleza = 1;
                $cuentas->cod_Descripcion = 0;
                $cuentas->save();
                $cuentas = new ContabilidadManual;
                $cuentas->cod_puc = 61;
                $cuentas->comprobante = 'Fv'.$factura->Num_factura;
                $cuentas->valor = $valores[$i]-$valores[$i]*0.19;
                $cuentas->fecha = date('Y-m-d');
                $cuentas->idFactura=$id;
                $cuentas->idArticulo=$detallefactura->idArticulo;
                $cuentas->naturaleza = 0;
                $cuentas->cod_Descripcion = 0;
                $cuentas->save();
            }
        }
        return Redirect::to('ventas');
    }
}
