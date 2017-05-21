@extends('layouts.admin')
<link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>

<link rel="stylesheet" href="{{asset('css/style.css')}}">
@section('contenido')
<div class="row" style="background-color:#00ADA9;">
<br> <br>
	<div class="col-xs-12" style="text-align:center">
		<h3>Listado de Articulos  <a href="articulo/create"><button class="btn btn-success">Nuevo</button></a> </h3>
		@include('almacen.articulo.search')
		<br> <br>
	</div>
</div>
<br> <br>
<div class="row active-with-click">
	@foreach ($articulos as $art)
			@if($art->Estado=="Activo")
			<?php 
				switch ($art->Color) {
					case 1:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Red">');
						break;
					case 2:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Pink">');
						break;
					case 3:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Purple">');
						break;
					case 4:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Deep-Purple">');
						break;
					case 5:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Indigo">');
						break;
					case 6:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Blue">');
						break;
					case 7:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Cyan">');
						break;
					case 8:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Teal">');
						break;
					case 9:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Green">');
						break;
					case 10:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Light-Green">');
						break;
					case 11:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Lime">');
						break;
					case 12:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Yellow">');
						break;
					case 13:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Amber">');
						break;
					case 14:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Orange">');
						break;
					case 15:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Deep-Orange">');
						break;
					case 16:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Brown">');
						break;
					case 17:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Grey">');
						break;
					case 18:
						echo('<div class="col-md-4 col-sm-6 col-xs-12">
		            			<article class="material-card Blue-Grey">');
						break;
				}
			 ?>
			 			<h2>
		                    <span>{{$art->nom_articulo}}</span>
		                    <!--strong>
		                        <i class="fa fa-fw fa-tree"></i>
		                        The Deer Hunter
		                    </strong-->
		                </h2>
		                <div class="mc-content">
		                    <div class="img-container">
		                        <img class="img-responsive" src="{{asset('Imagenes/Articulos/'.$art->Imagen)}}">
		                    </div>
		                    <div class="mc-description">
		                        Codigo de la Planta: {{ $art->idArticulos}}<br>
		                        Categoria: {{ $art->Nombre_categoria}}<br>
								Stock: {{ $art->stock}}<br>
								Minimo: {{$art->minimo}}<br>
								Maximo: {{$art->maximo}}<br>
								Precio de Venta: ${{number_format($art->Precio_venta)}}<br>
		                    </div>
		                </div>
		                <a class="mc-btn-action">
		                    <i class="fa fa-bars"></i>
		                </a>
		                <div class="mc-footer">
		                    <h4>
		                        Opciones
		                    </h4>
		                    <a class="fa fa-fw fa-pencil" title="Editar" href="{{URL::action('ArticulosController@edit',$art->idArticulos)}}"></a>
							<a class="fa fa-fw fa-trash" title="Eliminar" href="" data-target="#modal-delete-{{$art->idArticulos}}" data-toggle="modal"></a>
		                </div>
		            </article>
		        </div>
			@include('almacen.articulo.modal')
		@endif
	@endforeach
</div>

<div class="row hidden" id="lista">
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
					@if($art->Estado=="Activo")
					<tr>
						<td>{{ $art->idArticulos}}</td>
						<td>{{ $art->nom_articulo}}</td>
						<td>{{ $art->Nombre_categoria}}</td>
						<td>{{ $art->stock}}</td>
						<td>{{ $art->minimo}}</td>
						<td>{{ $art->maximo}}</td>
						<td class="text-center">
						<a href="{{URL::action('ArticulosController@edit',$art->idArticulos)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$art->idArticulos}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('almacen.articulo.modal')
					@endif
				@endforeach
				
			</table>
		</div>
	</div>
</div>
<div class="form-group text-right">
				<input class="btn btn-warning" type="button" id="inventario" value="Inventario">
</div>
<div class="form-group text-center">
		{{$articulos->appends(Request::only(['searchText']))->render()}}
</div>
<script type="text/javascript">
	$(document).ready(function () {
        $('#inventario').click(function () {
            if ($('#inventario').val()!="Inventario") {
            	$("#lista").addClass('hidden');
            	$('#inventario').val("Inventario");
            }else{
            	$("#lista").removeClass('hidden');
            	$('#inventario').val("Ocultar");
            }
        });
});
</script>
@endsection
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="{{asset('js/index.js')}}"></script>