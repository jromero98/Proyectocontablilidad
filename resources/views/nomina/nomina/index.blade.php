@extends('layouts.admin')
@section('contenido')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link href="{{asset('css/daterangepicker.css')}}" rel="stylesheet">

<div class="row" style="background-color: #D97925;">
<br> <br>
	<div class="col-xs-12" style="text-align:center">
		<h3>Listado de Nominas activas <a href="nomina/create"><button class="btn btn-success" id="nuevo">Nuevo</button></a> </h3>
		@include('nomina.nomina.search')
		<br> <br> 
	</div>
</div>
<br> <br>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="display table" id="empleados">
				<thead>
					<th>Cedula</th>
					<th>Nombre Trabajador</th>
					<th>Cargo</th>
					<th>Fecha</th>
					<th>Total a pagar</th>
					<th>Opciones</th>
				</thead>
				<tbody>
					@foreach($empleados as $empleado)
						<tr>
							<td>{{$empleado->ced_empleado}}</td>
							<td>{{$empleado->nombre_empleado}} {{$empleado->apellido_empleado}}</td>
							<td>{{$empleado->nombre_cargo}}</td>
							<td>{{Carbon\Carbon::parse($empleado->Fecha_nomina)->format('d/m/Y')}}</td>
							<td>{{number_format(
							$empleado->Diastrabajados*($empleado->Salario/30)+$empleado->Auxtransportes+$empleado->Bonificaciones+$empleado->Comisiones+$empleado->Auxalimentos+$empleado->Salario*1.25*$empleado->HorasED/240+$empleado->Salario*1.75*$empleado->HorasEN/240-$empleado->AporteEps-$empleado->Aportepension-$empleado->Aportefondoempleados-$empleado->libranza-$empleado->embargos-$empleado->retencionfuente
							)}}</td>
							@if ($pagado==0) 
							<td class="text-center">
							<a href="{{URL::action('NominaController@edit',$empleado->ced_empleado)}}"><button class="btn btn-info">Editar</button></a>
							<a href=""><button class="btn btn-success">Pagar</button></a>
							</td>
							@else
							<td></td>
							@endif
						</tr>
					@endforeach
				</tbody>
				<tfoot>
						@foreach($totales as $total)
							<th>Total Deducibles</th>
							<th>{{number_format($total->Deducibles)}}</th>
							<th>Total Devengados</th>
							<th>{{number_format($total->Devengados)}}</th>
							<th>Total</th>
							<th>{{number_format($total->Total)}}</th>
						@endforeach
					</tfoot>
			</table>
		</div>
	</div>
		<div class="form-group text-center">
			<a class="btn btn-primary hidden" type="submit" id="cerrar"  href="/cerrarnomina">Cerrar Nomina del Mes</a>
		</div>
</div>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var f = new Date();
		var f2 = new Date("{{$searchText}}");
		if ({{$pagado}}==0) {
			if ("01"+ "/" + (f2.getMonth() +1) + "/" + f2.getFullYear()<"01"+ "/" + (f.getMonth() +1) + "/" + f.getFullYear()) {
				$("#cerrar").addClass("hidden");
				$("#nuevo").addClass("hidden");
			}else{
				$("#cerrar").removeClass("hidden");
				$("#nuevo").removeClass("hidden");
			}
		}
		$(function () {
            $("#datetimepicker").datetimepicker({format:'DD/MM/YYYY H:m'});
        });
    $('#empleados').DataTable({
        "language": {
            "lengthMenu": "Ver _MENU_ nominas",
            "zeroRecords": "No se encontró nada - lo siento",
            "info": "Viendo pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay nominas disponibles",
            "infoFiltered": "(Filtrado de _MAX_ nominas totales)",
            "loadingRecords": "Cargando...",
		    "processing":     "Procesando...",
		    "search":         "Buscar:",
		    "paginate": {
		        "first":      "Primero",
		        "last":       "Ultimo",
		        "next":       "Siguiente",
		        "previous":   "Anterior"
		    },
		    "aria": {
		        "sortAscending":  ": Activar para ordenar la columna ascendente",
		        "sortDescending": ": Activar para ordenar la columna descendente"
		    }
        }
    });
} );
</script>
@endsection