@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-xs-12" style="text-align:center">
		<h3>Listado de Cargos <a href="cargos/create"><button class="btn btn-success">Nuevo</button></a> </h3>
		@include('nomina.cargos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Cargo</th>
					<th>Salario</th>
					<th>Riesgo</th>
					<th>Opciones</th>
				</thead>
				@foreach ($cargos as $cargo)
					<tr>
						<td>{{ $cargo->nombre_cargo}}</td>
						<td>{{ number_format($cargo->salario_cargo)}}</td>
						<td><?php 
							switch ($cargo->riesgo) {
								case 0.522:
									echo('Mínimo');
									break;
								case 1.044:
									echo('Bajo');
									break;
								case 2.436:
									echo('Medio');
									break;
								case 4.350:
									echo('Alto');
									break;
								case 6.960:
									echo('Máximo');
									break;
								default:
									echo "No Asignado";
									break;
							}
						 ?></td>
						<td class="text-center">
						<a href="{{URL::action('CargosController@edit',$cargo->idCargos)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$cargo->idCargos}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('nomina.cargos.modal')
				@endforeach
				
			</table>
		</div>
	</div>
</div>
@endsection