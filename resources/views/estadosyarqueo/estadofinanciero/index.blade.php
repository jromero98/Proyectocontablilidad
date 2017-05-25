@extends('layouts.admin')
@section('contenido')
<div class="row" style="background-color:#CBFF48;">
<br>
	<div class="col-xs-12" style="text-align:center">
		<h3>Estados Financieros <a href="estadofinanciero/create"><button class="btn btn-success">Nuevo</button></a> </h3>
		@include('estadosyarqueo.estadoderesultados.search')
		<br>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			
				<thead>
					<th>Nombre</th>
					<th>Fecha inicial</th>
					<th>Fecha final</th>
					<th>Opciones</th>
				</thead>
				
			</table>
		</div>
	</div>
</div>
@endsection