<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\DetalleFactura;
use App\Persona;
use App\Facturas;
use App\Articulos;
use Carbon\Carbon;
use DB;

class VentasController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $estado=$request->get('estado');
            if($request){
                if ($estado=="") {
                    $estado='Activo';$request->replace(array('estado' => 'Activo'));
                }
                if($query==""){
                    $facturas=DB::table('facturas')
                        ->join('detalle_factura','idfactura','=','idfacturas')
                        ->select('idfacturas','num_factura','fecha','estado',DB::raw('sum(cantidad*precio_venta-descuento) as total'))
                        ->where('estado','LIKE','%'.$estado.'%')->where('tipo_factura',"=","Fv")
                        ->groupby('idfacturas','num_factura','fecha','estado')
                        ->paginate(7);
                }else{
                    $facturas=DB::table('facturas')
                        ->join('detalle_factura','idfactura','=','idfacturas')
                        ->select('idfacturas','num_factura','fecha','estado',DB::raw('sum(cantidad*precio_venta-descuento) as total'))
                        ->where('estado','LIKE','%'.$estado.'%')->where('tipo_factura',"=","Fv")
                        ->where(DB::raw('CAST(num_factura AS TEXT)'),"LIKE",'%'.$query.'%')
                        ->groupby('idfacturas','num_factura','fecha','estado')
                        ->paginate(7);
                }
            }
            return view('facturacion.ventas.index',["facturas"=>$facturas,"searchText"=>$request]);
        }
    }
    public function edit($id){
        $tpfactura=Facturas::findOrFail($id);
        $detallefactura=DetalleFactura::where('idfactura','=',$tpfactura->idfacturas)->get();
        $articulos=DB::table('articulos')
        ->join('detalle_factura','idArticulo',"=","idArticulos")
        ->join('facturas','idfacturas','=','idfactura')
        ->select(DB::raw('CONCAT(idArticulos, " ",nom_articulo) as articulo'),'idArticulos','stock',DB::raw('avg(precio_venta) as precio_promedio'))
        ->where('tipo_factura',"=","Fc")
        ->where('stock','>','0')
        ->where('articulos.estado','=','Activo')
        ->groupby('articulo','idArticulos','stock')->get();
        
        $articulos2=DB::table('articulos')
        ->select(DB::raw('CONCAT(idArticulos, " ",nom_articulo) as articulo'),'idArticulos','stock',DB::raw('(0) as precio_promedio'))
        ->where('stock','>','0')
        ->where('estado','=','Activo')
        ->get();
        $valor=0;
        foreach ($detallefactura as $detalle) {
            $valor += ($detalle->cantidad*$detalle->precio_venta-$detalle->descuento);
        }
        $proveedores=Persona::get();
        return view('facturacion.ventas.edit',["articulos2"=>$articulos2,"articulos"=>$articulos,"factura"=>$tpfactura,"detalles"=>$detallefactura,"valor"=>$valor,"personas"=>$proveedores]);
    }
    public function create(){
        $tpfactura=DB::table('Facturas')
        ->select(DB::raw('count(tipo_factura) as cfactura'),'tipo_factura')
        ->where("tipo_factura","=","Fv")
        ->groupBy('tipo_factura')
        ->first();
        $articulos=Articulos::where('stock','>','0')
        ->where('estado','=','Activo')->get();
        $proveedores=Persona::get();
        return view('facturacion.ventas.create',["articulos"=>$articulos,"factura"=>$tpfactura,"personas"=>$proveedores]);
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
        $descuentos = Input::get('descuento');
        for($i=0;$i<count($descuentos);$i++){
            $descuentos[$i]=str_replace(",", "", $descuentos[$i]);
        }
        for($i=0;$i<count($articulos);$i++){
            for($i=0;$i<count($articulos);$i++){
                if($articulos[$i]==1){
                    
                }
            }
        }
        $articulos2=$articulos;
        $cantidades2=$cantidades;
        $precios2=$precios;
        $descuentos2=$descuentos;
        for($i=0;$i<count($articulos);$i++){
            for($j=$i+1;$j<count($articulos);$j++){
                if($articulos[$i]==$articulos[$j] && $i!=$j){
                    $precios[$i]=($cantidades[$j]*$precios[$j]+$cantidades[$i]*$precios[$i])/($cantidades[$i] + $cantidades[$j]);
                    $cantidades[$i] += $cantidades[$j];
                    $descuentos[$i] += $descuentos[$j];
                    $articulos[$j]=0;
                    $cantidades[$j]=0;
                    $precios[$j]=0;
                    $descuentos[$j]=0;
                }
            }
        }
        //los nuevos ingresos
        for($i=(count($articulos2)-count($detallefactura));$i<(count($articulos2));$i++){
            if((count($articulos2)-count($detallefactura))>0){
                $articulo=Articulos::findOrFail($articulos2[$i]);
                $articulo->stock=$articulo->stock-$cantidades2[$i];
                $articulo->update();
            }
        }        
        //los antiguos ingresos
        foreach($detallefactura as $detalle){
            DB::table('Detalle_factura')
            ->where('idfactura',"=",$factura->idfacturas)
            ->where('idArticulo','=',$detalle->idArticulo)->delete();
        }
        //total de ingresos
        for($i=0;$i<(count($articulos));$i++){
            if($articulos[$i]!=0){
                echo $articulos[$i]."  ".$cantidades[$i]." ".$precios[$i]." ".$descuentos[$i]."<br>";
                $prom=DB::table('facturas')
                                ->join('detalle_factura','idfactura','=','idfacturas')
                                ->select('idfacturas','num_factura','idArticulo','cantidad','prom')
                                ->where("idArticulo","=",$articulos[$i])
                                ->where('estado',"!=","Cancelado")
                                ->orderBy('fecha','DESC')
                                ->first();
            $articulo=Articulos::findOrFail($articulos[$i]);
            if (count($prom)==0) {
                $prom=DB::table('facturas')
                                ->join('detalle_factura','idfactura','=','idfacturas')
                                ->select('idfacturas','num_factura','idArticulo','cantidad','prom')
                                ->where("idArticulo","=",$articulos[$i])
                                ->where("tipo_factura","=","Fc")
                                ->where('estado',"!=","Cancelado")
                                ->orderBy('fecha','DESC')
                                ->first();
                $promedio=$prom->prom;
            }else{
                $promedio=((($articulo->stock+$cantidades2[$i])*$prom->prom)-($cantidades[$i]*$precios[$i]))/($articulo->stock);
            }
                DB::select('CALL crearfv(?,?,?,?,?.?)',array($articulos[$i], $factura->idfacturas,$cantidades[$i],$precios[$i],0,$promedio));
            }
        }
        return Redirect::to('ventas');
    }
    public function store(Request $request){
        $factura=new Facturas;
        $factura->tipo_factura='Fv';
        $factura->num_factura=$request->get('comprobante');
        $factura->fecha=$request->get('fecha')." ".Carbon::now('America/Bogota')->toTimeString();
        $factura->estado='Activo';
        $factura->doc_persona=Input::get('idproveedor');
        $factura->save();
        $articulos = Input::get('idarticulo');
        $cantidades = Input::get('cantidad');
        $precios = Input::get('precio_venta');
        for($i=0;$i<count($precios);$i++){
            $precios[$i]=str_replace(",", "", $precios[$i]);
        }
        $descuentos = Input::get('descuento');
        for($i=0;$i<count($descuentos);$i++){
            $descuentos[$i]=str_replace(",", "", $descuentos[$i]);
        }
        for($i=0;$i<count($articulos);$i++){
            $prom=DB::table('facturas')
                                ->join('detalle_factura','idfactura','=','idfacturas')
                                ->select('idfacturas','num_factura','idArticulo','cantidad','prom')
                                ->where("idArticulo","=",$articulos[$i])
                                ->where('estado',"!=","Cancelado")
                                ->orderBy('fecha','DESC')
                                ->first();
            $articulo=Articulos::findOrFail($articulos[$i]);
            if (count($prom)==0) {
                $promedio=$precios[$i];
            }else{
                $promedio=(($articulo->stock*$prom->prom)-($cantidades[$i]*$prom->prom))/($articulo->stock-$cantidades[$i]);
            }
            
            DB::select('CALL crearfv(?,?,?,?,?,?)',array($articulos[$i], $factura->idfacturas,$cantidades[$i],$precios[$i],0,$promedio));
            $articulo->Precio_venta=$precios[$i];
            $articulo->stock=$articulo->stock-$cantidades[$i];
            $articulo->update();
        }
        return Redirect::to('ventas');
    }
    public function destroy($id){
        $factura=Facturas::findOrFail($id);
        $detallesfactura=DetalleFactura::where("idfactura","=",$id)->get();
        foreach ($detallesfactura as $detallefactura) {
            $articulo=Articulos::findOrFail($detallefactura->idArticulo);
            $articulo->stock=$articulo->stock+$detallefactura->cantidad;
            $articulo->update();
        }
        $factura->estado='Cancelado';
        $factura->update();
        return Redirect::to('ventas');
    }
}
