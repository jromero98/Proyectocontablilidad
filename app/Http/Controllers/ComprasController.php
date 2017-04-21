<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests,PDF;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\DetalleFactura;
use App\Facturas;
use App\Articulos;
use Carbon\Carbon;
use DB;

class ComprasController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $estado=$request->get('estado');
            if($request){
                if($estado==""){$estado='Activo';$request->replace(array('estado' => 'Activo'));}
                $facturas=DB::table('facturas')
                ->join('detalle_factura','idFactura','=','idFacturas')
                ->select('idFacturas','Num_factura','fecha','Estado',DB::raw('sum(cantidad*precio_compra) as total'))
                ->where('Estado','LIKE','%'.$estado.'%')->where('Tipo_factura',"=","Fc")
                ->where('Num_factura','LIKE','%'.$query.'%')
                ->groupby('idFacturas','Num_factura','fecha','Estado')
                ->paginate(7);
            }
            return view('facturacion.compras.index',["facturas"=>$facturas,"searchText"=>$request]);
        }
    }
    public function edit($id){
        $tpfactura=Facturas::findOrFail($id);
        $detallefactura=DetalleFactura::where('idFactura','=',$tpfactura->idFacturas)->get();
        $articulos=Articulos::get();
        
        $valor=0;
        foreach ($detallefactura as $detalle) {
            $valor += ($detalle->cantidad*$detalle->precio_compra);
        }
        return view('facturacion.compras.edit',["factura"=>$tpfactura,"detalles"=>$detallefactura,"valor"=>$valor,"articulo"=>$articulos]);
    }
    public function create(){
        $tpfactura=DB::table('Facturas')
        ->select(DB::raw('count(Tipo_factura) as cfactura'),'Tipo_factura')
        ->where("Tipo_factura","=","Fc")
        ->groupBy('Tipo_factura')
        ->first();
        $articulos=Articulos::get();
        return view('facturacion.compras.create',["articulos"=>$articulos,"factura"=>$tpfactura]);
    }
    public function update(Request $request,$id){
        $factura=Facturas::findOrFail($id);
        $detallefactura=DetalleFactura::where('idFactura','=',$factura->idFacturas)->get();
        $articulos = Input::get('idarticulo');
        $cantidades = Input::get('cantidad');
        $precios = Input::get('precio_venta');
        for($i=0;$i<count($precios);$i++){
            $precios[$i]=str_replace(",", "", $precios[$i]);
        }
        $preciosc = Input::get('precio_compra');
        for($i=0;$i<count($preciosc);$i++){
            $preciosc[$i]=str_replace(",", "", $preciosc[$i]);
        }
        $articulos2=$articulos;
        $cantidades2=$cantidades;
        $precios2=$precios;
        $preciosc2=$preciosc;
        for($i=0;$i<count($articulos);$i++){
            for($j=$i+1;$j<count($articulos);$j++){
                if($articulos[$i]==$articulos[$j] && $i!=$j){
                    $cantidades[$i] += $cantidades[$j];
                    $precios[$i]=($precios[$j]+$precios[$i])/2;
                    $preciosc[$i] = ($preciosc[$j]+$preciosc[$i])/2;
                    $articulos[$j]=0;
                    $cantidades[$j]=0;
                    $precios[$j]=0;
                    $preciosc[$j]=0;
                }
            }
        }
        for($i=(count($articulos2)-count($detallefactura));$i<(count($articulos2));$i++){
            if((count($articulos2)-count($detallefactura))>0){
                echo $articulos2[$i]."  ".$cantidades2[$i]." ".$precios2[$i]." ".$preciosc2[$i]."<br>";
                $articulo=Articulos::findOrFail($articulos2[$i]);
                $articulo->stock=$articulo->stock+$cantidades2[$i];
                $articulo->update();
            }
        }
        foreach($detallefactura as $detalle){
            DB::table('Detalle_factura')
            ->where('idFactura',"=",$factura->idFacturas)
            ->where('idArticulo','=',$detalle->idArticulo)->delete();
        }
        for($i=0;$i<(count($articulos));$i++){
            if($articulos[$i]!=0){
                DB::select('CALL crearfc(?,?,?,?,?)',array($articulos[$i], $factura->idFacturas,$cantidades[$i],$preciosc[$i],$precios[$i]));
            }
        }
        return Redirect::to('compras');
    }
    public function store(Request $request){
        $factura=new Facturas;
        $factura->Tipo_factura='Fc';
        $factura->num_factura=$request->get('comprobante');
        $factura->fecha=$request->get('fecha')." ".Carbon::now('America/Bogota')->toTimeString();
        $factura->Estado='Activo';
        $factura->save();
        echo  $factura->idFacturas;
        $articulos = Input::get('idarticulo');
        $cantidades = Input::get('cantidad');
        $precios = Input::get('precio_venta');
        for($i=0;$i<count($precios);$i++){
            $precios[$i]=str_replace(",", "", $precios[$i]);
        }
        $preciosc = Input::get('precio_compra');
        for($i=0;$i<count($preciosc);$i++){
            $preciosc[$i]=str_replace(",", "", $preciosc[$i]);
        }for($i=0;$i<count($articulos);$i++){
            DB::select('CALL crearfc(?,?,?,?,?)',array($articulos[$i], $factura->idFacturas,$cantidades[$i],$preciosc[$i],$precios[$i]));
            $articulo=Articulos::findOrFail($articulos[$i]);
            $articulo->stock=$articulo->stock+$cantidades[$i];
            $articulo->update();
        }
        return Redirect::to('compras');
    }
    public function destroy($id){
        $factura=Facturas::findOrFail($id);
        $factura->Estado='Cancelado';
        $factura->update();
    }
}
