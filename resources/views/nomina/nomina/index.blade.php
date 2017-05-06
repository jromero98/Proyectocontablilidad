@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-xs-12" style="text-align:center">
		<h3>Listado de Nominas activas <a href="nomina/create"><button class="btn btn-success">Nuevo</button></a> </h3>
		@include('nomina.nomina.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Cedula</th>
					<th>Nombre Trabajador</th>
					<th>Cargo</th>
					<th>Fecha</th>
					<th>Total a pagar</th>
					<th>Opciones</th>
				</thead>
				@foreach($empleados as $empleado)
					<tr>
						<td>{{$empleado->ced_empleado}}</td>
						<td>{{$empleado->nombre_empleado}} {{$empleado->apellido_empleado}}</td>
						<td>{{$empleado->nombre_cargo}}</td>
						<td></td>
						<td></td>
						<td class="text-center">
						<a href="{{URL::action('NominaController@edit',$empleado->ced_empleado)}}"><button class="btn btn-info">Editar</button></a>
						<a href=""><button class="btn btn-success">Pagar</button></a>
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection