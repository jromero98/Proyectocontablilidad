@extends('layouts.admin')
@section('contenido')
<div class="row" style="background-color:#CBFF48;">
<br>
	<div class="col-xs-12" style="text-align:center">
		<h3>Estado de resultados <a href="estadoderesultados/create"><button class="btn btn-success">Nuevo</button></a> </h3>
		@include('estadosyarqueo.estadoderesultados.search')
		<br>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			
				<thead>
					<th>Id</th>
					<th>Fecha inicial</th>
					<th>Fecha final</th>
					<th>Opciones</th>
				</thead>
				@foreach($estados as $estado)
					<tr>
						<td>{{$estado->id}}</td>
						<td>{{$estado->fechainicio}}</td>
						<td>{{$estado->fechafin}}</td>
						<td class="text-center">
						<a href="{{URL::action('EstadosyArqueoController@edit',$estado->id)}}"><button class="btn btn-info">Ver</button></a>
						</td>
					</tr
				@endforeach				
			</table>
		</div>
	</div>
</div>
@endsection