@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Facturas de venta   <a class="btn btn-labeled btn btn-success" href="ventas/create"><span class="btn-label"><i class="fa fa-cart-plus"></i></span>Nueva</a> </h3>
		@include('facturacion.ventas.search')
		<br/>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>N°Factura</th>
					<th>Fecha</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
				@foreach($facturas as $factura)
				    <tr>
						<td>{{$factura->Num_factura}}</td>
						<td>{{Carbon\Carbon::parse($factura->fecha)->format('d/m/Y')}}</td>
						<td>${{number_format($factura->total)}}</td>
						<td>{{$factura->Estado}}</td>
						@if($factura->Estado=='Activo')
						    <td class="col-lg-4">
                                <a href="{{URL::action('HacerFactura@pdf2',$factura->idFacturas)}}"><button class="btn btn-primary">Imprimir</button></a>
                                <a href="{{URL::action('VentasController@edit',$factura->idFacturas)}}"><button class="btn btn-info">Editar</button></a>
                                <a href="" data-target="#modal-delete-{{$factura->idFacturas}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </td>
						@endif
						@if($factura->Estado=='Pendiente')
						<td class="col-lg-4">
                            <a href="#"><button class="btn btn-primary">Pagar</button></a>
						</td>
						@endif
						
					</tr>
					@include('facturacion.ventas.modal')
				@endforeach
			</table>
			{{$facturas->appends(Request::only(['searchText','estado']))->render()}}
		</div>
	</div>
</div>
@endsection