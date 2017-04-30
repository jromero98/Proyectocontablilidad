@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-xs-12" style="text-align:center">
		<h3>Administrar Puc   <a href="puc/create"><button class="btn btn-success">Nueva</button></a> </h3>
		@include('administracion_puc.search')
		<br/>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Cuenta</th>
					<th>Descripción</th>
					<th>Pertenece a</th>
					<th>Opciones</th>
				</thead>
				@foreach($pucs as $puc)
				    <tr>
						<td>{{$puc->cod_puc}}</td>
						<td>{{$puc->nom_puc}}</td>
						<td>
						@if($puc->clase_puc==1)Activo
						@elseif($puc->clase_puc==2)Pasivo
						@elseif($puc->clase_puc==3)Patrimonio
						@elseif($puc->clase_puc==4)Ingreso
						@elseif($puc->clase_puc==5)Gasto
						@elseif($puc->clase_puc==6)Costo
						@endif
						</td>
						<td class="text-center">
						    <a href="{{URL::action('AdministrarPucController@edit',$puc->cod_puc)}}"><button class="btn btn-info">Editar</button></a>
						    <a href="" data-target="#modal-delete-{{$puc->cod_puc}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('administracion_puc.modal')
				@endforeach
			</table>
			<div class="text-center">
			    {{$pucs->appends(Request::only(['searchText','clase']))->render()}}
			</div>
		</div>
	</div>
</div>
@endsection