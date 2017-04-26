@extends('layouts.admin')
@section('contenido')
    <div id="striped" class="section scrollspy">
            <h2 class="header"> Kardex</h2>
    </div>
    <?php $articulor=$busqueda ?>

@if(!count($facturas)==0)
@include('contabilidad_manual.searchkkardex')
<div style="overflow-x: auto;">
    <table width="50" class="table table-striped table-bordered" id="myTable">
        <thead class="thead-inverse">
            <tr>
                <th data-field="Fecha"class="text-center" colspan="2"></th>
                <th data-field="entradas"class="text-center" colspan="3">Entradas
                </th>
                <th data-field="Cantidad" class="text-center" colspan="3">Salidas
                </th>
                <th data-field="Valor U" class="text-center" colspan="3">Saldos
                </th>
            </tr>
            <tr>
                <th data-field="Fecha">Fecha</th>
                <th data-field="Detalle">Detalle</th>
                <th data-field="Cantidad">Cantidad</th>
                <th data-field="Valor U">Valor U</th>
                <th data-field="VTotal">VTotal</th>
                <th data-field="Cantidad">Cantidad</th>
                <th data-field="Valor U">Valor U</th>
                <th data-field="VTotal">VTotal</th>
                <th data-field="Cantidad">Cantidad</th>
                <th data-field="Valor U">Valor U</th>
                <th data-field="VTotal">VTotal</th>  
            </tr>
        </thead>
        <tbody>
        <?php $cont=0 ?>
        @foreach($facturas as $factura)
            <?php 
                   if($articulor!=""){
                        $detallesfactura=DB::table('facturas')
                            ->join('detalle_factura','idFactura','=','idFacturas')
                            ->select('idFacturas','Num_factura','idArticulo','cantidad','precio_compra','precio_venta',DB::raw('(cantidad*precio_compra) as total'),DB::raw('(cantidad*precio_venta) as total2'))
                            ->where('idFacturas',"=",$factura->idFacturas)->where("idArticulo","=",$articulor)
                            ->get();
                   }
                   else{
                        $detallesfactura=DB::table('facturas')
                            ->join('detalle_factura','idFactura','=','idFacturas')
                            ->select('idFacturas','Num_factura','idArticulo','cantidad','precio_compra','precio_venta',DB::raw('(cantidad*precio_compra) as total'),DB::raw('(cantidad*precio_venta) as total2'))
                            ->where('idFacturas',"=",$factura->idFacturas)
                            ->get();
                   }
                    ?>

        @endforeach
        @foreach($facturas as $factura)
        <?php 
                   if($articulor!=""){
                        $detallesfactura=DB::table('facturas')
                            ->join('detalle_factura','idFactura','=','idFacturas')
                            ->select('idFacturas','Num_factura','idArticulo','cantidad','precio_compra','precio_venta',DB::raw('(cantidad*precio_compra) as total'),DB::raw('(cantidad*precio_venta) as total2'))
                            ->where('idFacturas',"=",$factura->idFacturas)->where("idArticulo","=",$articulor)
                            ->get();
                   }
                   else{
                        $detallesfactura=DB::table('facturas')
                            ->join('detalle_factura','idFactura','=','idFacturas')
                            ->select('idFacturas','Num_factura','idArticulo','cantidad','precio_compra','precio_venta',DB::raw('(cantidad*precio_compra) as total'),DB::raw('(cantidad*precio_venta) as total2'))
                            ->where('idFacturas',"=",$factura->idFacturas)
                            ->get();
                   }
                    ?>
            @if($cont==0)
                <tr>
                   <td ></td>
                   <td>Stock inicial
                   </td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                       
                    @foreach($articulos as $articulo)
                        @if($articulor==$articulo->idArticulos)
                            <td >{{$articulo->stock}}</td>
                            <td></td>
                            <td></td>
                        @endif
                    @endforeach
                 </tr>
            @endif
        @if(count($detallesfactura)==0)
        @else
                <tr>
                   <td >{{Carbon\Carbon::parse($factura->fecha)->format('d/m/Y')}}</td>
                   <td>
                       @if($factura->Tipo_factura=="Fv")
                            Venta
                       @else
                            Compra
                       @endif
                   </td>
                    @foreach($detallesfactura as $detalle)
                        @if($factura->Tipo_factura=="Fv")
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td >{{$detalle->cantidad}}</td>
                            <td >{{number_format($detalle->precio_venta)}}</td>
                            <td >{{number_format($detalle->total2)}}</td>

                            @foreach($articulos as $articulo)
                        @if($articulor==$articulo->idArticulos)
                            <?php $articulo->stock=$articulo->stock-$detalle->cantidad ?>
                            <td >{{$articulo->stock}}</td>
                            <td>{{number_format($detalle->precio_venta)}}</td>
                            <td>{{number_format($articulo->stock*$detalle->precio_venta)}}</td>
                        @endif
                    @endforeach
                       @else
                            <td >{{$detalle->cantidad}}</td>
                            <td >{{number_format($detalle->precio_compra)}}</td>
                            <td >{{number_format($detalle->total)}}</td>
                            <td ></td>
                            <td ></td>
                            <td ></td>

                            @foreach($articulos as $articulo)
                        @if($articulor==$articulo->idArticulos)
                            <?php $articulo->stock=$articulo->stock+$detalle->cantidad ?>
                            <td >{{$articulo->stock}}</td>
                            <td>{{number_format($detalle->precio_compra)}}</td>
                            <td>{{number_format($articulo->stock*$detalle->precio_compra)}}</td>
                        @endif
                    @endforeach
                       @endif
                    @endforeach
                 </tr>
        <?php $cont=1; ?>
        @endif
        @endforeach
        </tbody>
    </table>
</div>
@else
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>¡Upps!</strong> No se encontraron datos asociados a la busqueda en nuestros registros.
</div>
@endif
@endsection