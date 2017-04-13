<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facturas;
use App\DetalleFactura;
use App\Articulos;

class HacerFactura extends Controller
{
    public function pdf($id){
       $factura=Facturas::findOrFail($id);
        $factura->Estado='Pendiente';
        $factura->update();
         $detalles=DetalleFactura::where('idFactura','=',$factura->idFacturas)->get();
        $articulos=Articulos::get();
        
        $valor=0;
        foreach ($detalles as $detalle) {
            $valor += ($detalle->cantidad*$detalle->precio_compra);
        }
        /*return view('facturacion.compras.edit',["factura"=>$tpfactura,"detalles"=>$detallefactura,"valor"=>$valor,"articulo"=>$articulos]);*/
        $data = $detallefactura=DetalleFactura::where('idFactura','=',$factura->idFacturas)->get();
        $date = date('Y-m-d');
        $view =  \View::make("facturacion.compras.pdf", compact('data', 'date','valor','articulos','detalles','factura'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        return $pdf->stream('reporte');
        
        //$pdf = PDF::loadView('facturacion.compras.pdf', [$detallefactura=DetalleFactura::where('idFactura','=',$tpfactura->idFacturas)->get()]);
        //return $pdf->download('invoice.pdf');
    }
    public function pdf2($id){
        $factura=Facturas::findOrFail($id);
        $factura->Estado='Pendiente';
        $factura->update();
        $detalles=DetalleFactura::where('idFactura','=',$factura->idFacturas)->get();
        $articulos=Articulos::get();
        
        $valor=0;
        foreach ($detalles as $detalle) {
            $valor += ($detalle->cantidad*$detalle->precio_venta);
        }
        /*return view('facturacion.compras.edit',["factura"=>$tpfactura,"detalles"=>$detallefactura,"valor"=>$valor,"articulo"=>$articulos]);*/
        $data = $detallefactura=DetalleFactura::where('idFactura','=',$factura->idFacturas)->get();
        $date = date('Y-m-d');
        $view =  \View::make("facturacion.ventas.pdf", compact('data', 'date','valor','articulos','detalles','factura'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        return $pdf->stream('reporte');
        
        //$pdf = PDF::loadView('facturacion.compras.pdf', [$detallefactura=DetalleFactura::where('idFactura','=',$tpfactura->idFacturas)->get()]);
        //return $pdf->download('invoice.pdf');
    }
}
