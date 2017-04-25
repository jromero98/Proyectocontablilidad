@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-xs-12" style="text-align:center">
		<h3>Listado de Articulos  <a href="articulo/create"><button class="btn btn-success">Nuevo</button></a> </h3>
		@include('almacen.articulo.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Categoria</th>
					<th>Stock</th>
					<th>Minimo</th>
					<th>Maximo</th>
					<th>Opciones</th>
				</thead>
				@foreach ($articulos as $art)
					<tr>
						<td>{{ $art->idArticulos}}</td>
						<td>{{ $art->nom_articulo}}</td>
						<td>{{ $art->Nombre_categoria}}</td>
						<td>{{ $art->stock}}</td>
						<td>{{ $art->minimo}}</td>
						<td>{{ $art->maximo}}</td>
						<td>
						<a href="{{URL::action('ArticulosController@edit',$art->idArticulos)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$art->idArticulos}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('almacen.articulo.modal')
				@endforeach
				
			</table>
		</div>
		{{$articulos->appends(Request::only(['searchText']))->render()}}
	</div>
</div>
@endsection