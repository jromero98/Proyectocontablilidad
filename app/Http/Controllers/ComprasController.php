<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests,PDF;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\DetalleFactura;
use App\Persona;
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
                if($query==""){
                    $facturas=DB::table('facturas')
                        ->join('detalle_factura','idfactura','=','idfacturas')
                        ->select('idfacturas','num_factura','fecha','estado',DB::raw('sum(cantidad*precio_compra) as total'))
                        ->where('estado','LIKE','%'.$estado.'%')->where('tipo_factura',"=","Fc")
                        ->groupby('idfacturas','num_factura','fecha','estado')
                        ->paginate(7);
                }else{
                    $facturas=DB::table('facturas')
                        ->join('detalle_factura','idfactura','=','idfacturas')
                        ->select('idfacturas','num_factura','fecha','estado',DB::raw('sum(cantidad*precio_compra) as total'))
                        ->where('estado','LIKE','%'.$estado.'%')->where('tipo_factura',"=","Fc")
                        ->where(DB::raw('CAST(num_factura AS TEXT)'),'LIKE','%'.$query.'%')
                        ->groupby('idfacturas','num_factura','fecha','estado')
                        ->paginate(7);
                }
            }
            return view('facturacion.compras.index',["facturas"=>$facturas,"searchText"=>$request]);
        }
    }
    public function edit($id){
        $tpfactura=Facturas::findOrFail($id);
        $detallefactura=DetalleFactura::where('idfactura','=',$tpfactura->idfacturas)->get();
        $articulos=Articulos::where("estado","!=","Inactivo")->get();
        
        $valor=0;
        foreach ($detallefactura as $detalle) {
            $valor += ($detalle->cantidad*$detalle->precio_compra);
        }
        $proveedores=Persona::get();
        return view('facturacion.compras.edit',["factura"=>$tpfactura,"detalles"=>$detallefactura,"valor"=>$valor,"articulo"=>$articulos,"personas"=>$proveedores]);
    }
    public function create(){
        $tpfactura=DB::table('Facturas')
        ->select(DB::raw('count(tipo_factura) as cfactura'),'tipo_factura')
        ->where("tipo_factura","=","Fc")
        ->groupBy('tipo_factura')
        ->first();
        $articulos=Articulos::where("estado","!=","Inactivo")->get();
        $proveedores=Persona::get();
        return view('facturacion.compras.create',["articulos"=>$articulos,"factura"=>$tpfactura,"personas"=>$proveedores]);
    }
    public function update(Request $request,$id){
        $factura=Facturas::findOrFail($id);
        $factura->doc_persona=Input::get('idproveedor');
        $factura->update();
        $detallefactura=DetalleFactura::where('idfactura','=',$factura->idfacturas)->get();
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
            ->where('idfactura',"=",$factura->idfacturas)
            ->where('idArticulo','=',$detalle->idArticulo)->delete();
        }
        for($i=0;$i<(count($articulos));$i++){
            if($articulos[$i]!=0){
                $prom=DB::table('facturas')
                                ->join('detalle_factura','idfactura','=','idfacturas')
                                ->select('idfacturas','num_factura','idArticulo','cantidad','prom')
                                ->where("idArticulo","=",$articulos[$i])
                                ->where('estado',"!=","Cancelado")
                                ->orderBy('fecha','DESC')
                                ->first();
            $articulo=Articulos::findOrFail($articulos[$i]);
            if (count($prom)==0) {
                $promedio=$preciosc[$i];
            }else{
                $promedio=((($articulo->stock-$cantidades2[$i])*$prom->prom)+($cantidades[$i]*$precios[$i]))/($articulo->stock);
            }
                DB::select('CALL crearfc(?,?,?,?,?,?)',array($articulos[$i], $factura->idfacturas,$cantidades[$i],$preciosc[$i],$precios[$i],$promedio));
            }
        }
        return Redirect::to('compras');
    }
    public function store(Request $request){
        $factura=new Facturas;
        $factura->tipo_factura='Fc';
        $factura->num_factura=$request->get('comprobante');
        $factura->fecha=$request->get('fecha')." ".Carbon::now('America/Bogota')->toTimeString();
        $factura->estado='Activo';
        $factura->doc_persona=Input::get('idproveedor');
        $factura->save();
        echo  $factura->idfacturas;
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
            $prom=DB::table('facturas')
                                ->join('detalle_factura','idfactura','=','idfacturas')
                                ->select('idfacturas','num_factura','idArticulo','cantidad','prom')
                                ->where("idArticulo","=",$articulos[$i])
                                ->where('estado',"!=","Cancelado")
                                ->orderBy('fecha','DESC')
                                ->first();
            $articulo=Articulos::findOrFail($articulos[$i]);
            if (count($prom)==0) {
                $promedio=$preciosc[$i];
            }else{
                $promedio=(($articulo->stock*$prom->prom)+($cantidades[$i]*$preciosc[$i]))/($articulo->stock+$cantidades[$i]);
            }
            DB::select('CALL crearfc(?,?,?,?,?,?)',array($articulos[$i], $factura->idfacturas,$cantidades[$i],$preciosc[$i],$precios[$i],$promedio));
            $articulo=Articulos::findOrFail($articulos[$i]);
            $articulo->stock=$articulo->stock+$cantidades[$i];
            $articulo->update();
        }
        return Redirect::to('compras');
    }
    public function destroy($id){
        $factura=Facturas::findOrFail($id);
        $detallesfactura=DetalleFactura::where("idfactura","=",$id)->get();
        foreach ($detallesfactura as $detallefactura) {
            $articulo=Articulos::findOrFail($detallefactura->idArticulo);
            $articulo->stock=$articulo->stock-$detallefactura->cantidad;
            $articulo->update();
        }
        $factura->estado='Cancelado';
        $factura->update();
        return Redirect::to('compras');
    }
}
