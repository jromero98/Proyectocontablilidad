@extends('layouts.admin')
@section('contenido')
<div class="row" style="background-color:#00ADA9;">
<br> <br>
	<div class="col-xs-12" style="text-align:center">
		<h3>Listado de Categorias <a href="categoria/create"><button class="btn btn-success">Nuevo</button></a> </h3>
		@include('almacen.categoria.search')
		<br> <br>
	</div>
</div>
<br> <br> 
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th>Opciones</th>
				</thead>
				@foreach ($categorias as $cat)
					<tr>
						<td>{{ $cat->nombre_categoria}}</td>
						<td>{{ $cat->descripcion}}</td>
						<td class="text-center">
						<a href="{{URL::action('CategoriasController@edit',$cat->idcategorias)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$cat->idcategorias}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('almacen.categoria.modal')
				@endforeach
				
			</table>
		</div>
		{{$categorias->appends(Request::only(['searchText']))->render()}}
	</div>
</div>
@endsection