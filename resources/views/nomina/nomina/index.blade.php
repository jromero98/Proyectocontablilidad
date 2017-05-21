@extends('layouts.admin')
@section('contenido')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link href="{{asset('css/daterangepicker.css')}}" rel="stylesheet">
<style type="text/css">
	th,tr{
		text-align: center;
	}
</style>
<div class="row">
	<div class="col-xs-12" style="text-align:center">
		<h3>Listado de Nominas activas <a href="nomina/create"><button class="btn btn-success" id="nuevo">Nuevo</button></a> </h3>
		@include('nomina.nomina.search')
	</div>
</div>

<div class="row">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Nomina</a>
          </li>
          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Aportes</a>
          </li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
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

			<?php $AporteEps=0;	$AportePension=0; $ARL=0; $SENA=0; $ICBF=0;	$Cajacompensacion=0; $Cesantias=0; $Interesescesantias=0;$Prima=0; $Vacaciones=0; $APagar=0; ?>
          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="display table" id="aportes">
						<thead>
							<th>Nombre Trabajador</th>
							<th>Aporte Eps</th>
							<th>Aporte Pension</th>
							<th>ARL</th>
							<th>SENA</th>
							<th>ICBF</th>
							<th>Caja de compensacion</th>
							<th>Cesantias</th>
							<th>Intereses cesantias</th>
							<th>Prima</th>
							<th>Vacaciones</th>
							<th>A Pagar</th>
						</thead>
						<tbody>
							@foreach($empleados as $empleado)
								<tr>
									<td>{{$empleado->nombre_empleado}} {{$empleado->apellido_empleado}}</td>
									<td>
										<?php  $AporteEps+=($empleado->Devengado-$empleado->Auxtransportes)*0.085;?>
										{{number_format(($empleado->Devengado-$empleado->Auxtransportes)*0.085)}}
									</td>
									<td>
										<?php $AportePension+=($empleado->Devengado-$empleado->Auxtransportes)*0.12; ?>
										{{number_format(($empleado->Devengado-$empleado->Auxtransportes)*0.12)}}
									</td>
									<td>
										<?php $ARL+=($empleado->Devengado-$empleado->Auxtransportes)*($empleado->riesgo/100) ?>
										{{number_format(($empleado->Devengado-$empleado->Auxtransportes)*($empleado->riesgo/100))}}
									</td>
									<td>
										<?php $SENA+=($empleado->Devengado-$empleado->Auxtransportes)*0.02; ?>
										{{number_format(($empleado->Devengado-$empleado->Auxtransportes)*0.02)}}
									</td>
									<td>
										<?php $ICBF+=($empleado->Devengado-$empleado->Auxtransportes)*0.03; ?>
										{{number_format(($empleado->Devengado-$empleado->Auxtransportes)*0.03)}}
									</td>
									<td>
										<?php $Cajacompensacion+=($empleado->Devengado-$empleado->Auxtransportes)*0.04; ?>
										{{number_format(($empleado->Devengado-$empleado->Auxtransportes)*0.04)}}
									</td>
									<td>
										<?php $Cesantias+=($empleado->Devengado)*0.0833 ?>
										{{number_format(($empleado->Devengado)*0.0833)}}
									</td>
									<td>
										<?php $Interesescesantias+=(($empleado->Devengado)*0.0833)*0.01; ?>
										{{number_format((($empleado->Devengado)*0.0833)*0.01)}}
									</td>
									<td>
										<?php $Prima+=($empleado->Devengado)*0.0833; ?>
										{{number_format(($empleado->Devengado)*0.0833)}}
									</td>
									<td>
										<?php $Vacaciones+=($empleado->Devengado)*0.0417; ?>
										{{number_format(($empleado->Devengado)*0.0417)}}
									</td>
									<td>
										<?php $APagar+=(($empleado->Devengado-$empleado->Auxtransportes)*0.085)+(($empleado->Devengado-$empleado->Auxtransportes)*0.12)+(($empleado->Devengado-$empleado->Auxtransportes)*($empleado->riesgo/100))+(($empleado->Devengado-$empleado->Auxtransportes)*0.02)+(($empleado->Devengado-$empleado->Auxtransportes)*0.03)+(($empleado->Devengado-$empleado->Auxtransportes)*0.04)+(($empleado->Devengado)*0.0833)+((($empleado->Devengado)*0.0833)*0.01)+(($empleado->Devengado)*0.0833)+(($empleado->Devengado)*0.0417); ?>
										{{number_format((($empleado->Devengado-$empleado->Auxtransportes)*0.085)+(($empleado->Devengado-$empleado->Auxtransportes)*0.12)+(($empleado->Devengado-$empleado->Auxtransportes)*($empleado->riesgo/100))+(($empleado->Devengado-$empleado->Auxtransportes)*0.02)+(($empleado->Devengado-$empleado->Auxtransportes)*0.03)+(($empleado->Devengado-$empleado->Auxtransportes)*0.04)+(($empleado->Devengado)*0.0833)+((($empleado->Devengado)*0.0833)*0.01)+(($empleado->Devengado)*0.0833)+(($empleado->Devengado)*0.0417))}}
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
									<th>Total</th>
									<th>{{number_format($AporteEps)}}</th>
									<th>{{number_format($AportePension)}}</th>
									<th>{{number_format($ARL)}}</th>
									<th>{{number_format($SENA)}}</th>
									<th>{{number_format($ICBF)}}</th>
									<th>{{number_format($Cajacompensacion)}}</th>
									<th>{{number_format($Cesantias)}}</th>
									<th>{{number_format($Interesescesantias)}}</th>
									<th>{{number_format($Prima)}}</th>
									<th>{{number_format($Vacaciones)}}</th>
									<th>{{number_format($APagar)}}</th>
							</tfoot>
					</table>
				</div>
			</div>
          </div>
        </div>
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
    $('#aportes').DataTable({
        "language": {
            "lengthMenu": "Ver _MENU_ aportes",
            "zeroRecords": "No se encontró nada - lo siento",
            "info": "Viendo pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay aportes disponibles",
            "infoFiltered": "(Filtrado de _MAX_ aportes totales)",
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