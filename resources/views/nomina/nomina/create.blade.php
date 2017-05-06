@extends ('layouts.admin')
@section ('contenido')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<h3>Nueva Nomina</h3>
			</div>
		</div>  
	    {!!Form::open(array('id'=>'formulario1','url'=>'nomina','method'=>'POST','autocomplete'=>'off'))!!}
	    {{Form::token()}}

		<div class="row"> 
			<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
				<label form="empleado">Empleado</label>
				<select name="idempleado" id="empleado" class="form-control selectpicker" data-live-search="true">
					<option value=""> Seleccione Empleado</option>
					@foreach($empleados as $empleado)
						<option value="{{$empleado->ced_empleado}}">{{$empleado->ced_empleado}}  {{$empleado->nombre_empleado}}  {{$empleado->apellido_empleado}}</option>
					@endforeach
				</select>
			</div>
			<br>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div class="form-group">
					<label for="diast">Dias trabajados</label>
					<input type="number" class="form-control" name="diast" id="diast" placeholder="Dias trabajados">
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div class="form-group">
					<label for="salario">Salario</label>
					<input type="text" class="form-control" name="salario" id="salario" readonly="" placeholder="Salario">
				</div>
			</div>			
		</div>
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="col-md-3">
						<input type="checkbox" name="devengado" id="hed"> Horas Extras Diurnas
					</div>
					<div class="col-md-3">
						<input type="checkbox" name="devengado" id="hen"> Horas Extras Nocturnas
					</div>
					<div class="col-md-3">
						<input type="checkbox" name="devengado" id="axt"> Auxilio de Transporte
					</div>
					<div class="col-md-3">
						<input type="checkbox" name="devengado" id="axc"> Auxilio de Alimentos
					</div>

					<table id="Devengados" border="" class="table table-striped table-bordered">
						<th style="background-color:#A9D0F5 " colspan="3" class="text-center"> Devengados </th>
						<tr id="dhed">
							<th style="background-color:#A9D0F5 " class="col-md-2">Horas Extras Diurnas</th>
							<td><input type="number" class="form-control" name="horased" id="horased" placeholder="Horas extas Diurnas"></td>
							<td><input type="text" class="form-control" name="hedsalario" id="hedsalario" readonly="" placeholder="Valor"></td>
						</tr>
						<tr id="dhen">
							<th style="background-color:#A9D0F5 " class="col-md-2">Horas Extras Nocturnas</th>
							<td><input type="number" class="form-control" name="horasen" id="horasen" placeholder="Horas extas Nocturnas"></td>
							<td><input type="text" class="form-control" name="hensalario" id="hensalario" readonly="" placeholder="Valor"></td>
						</tr>
						<tr id="daxt">
							<th style="background-color:#A9D0F5 " class="col-md-2">Auxilio Transporte</th>
							<td COLSPAN=2><input type="text" class="form-control" name="auxtrans" id="auxtrans" readonly="" placeholder="Auxilio de transporte"></td>
						</tr>
						<tr id="daxc">
							<th style="background-color:#A9D0F5 " class="col-md-2">Auxilio Comida</th>
							<td COLSPAN=2><input type="text" class="form-control" name="auxcom" id="auxcom" readonly="" placeholder="Auxilio de comida"></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<input type="text" id="sueldo" class="hidden">
		<input type="text" id="salariomin" value="737717" class="hidden">
		<input type="text" id="auxtransporte" value="83140" class="hidden">
		<input type="text" id="comida" value="8000" class="hidden">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group row" id="guardar">
				<div class="form-group">
					<input type="hidden" value="{{ csrf_token() }}" name="token">
					<button class="btn btn-primary hidden" type="submit">Guardar</button>
					<a href="/nomina" class="btn btn-danger">Cancelar</a>
				</div>
		</div>
{!!Form::close()!!}
<script type="text/javascript">
	$(document).on('keyup', '#diast',event => {
		$("#salario").val(number_format(($("#sueldo").val()/30)*$("#diast").val()),0);
	});
	setInterval( function() { 
    	if (document.getElementById('hed').checked){
			$('#dhed').removeClass('hidden');
		    $(document).on('keyup', '#horased',event => {
				$("#hedsalario").val(number_format(($("#sueldo").val()*1.25*$("#horased").val()/240)),0);
			});
		}else{
				$('#dhed').addClass('hidden');
				$("#hedsalario").val("");
				$("#horased").val("");
		}

		if (document.getElementById('hen').checked){
			$('#dhen').removeClass('hidden');
		    $(document).on('keyup', '#horasen',event => {
				$("#hensalario").val(number_format(($("#sueldo").val()*1.75*$("#horasen").val()/240)),0);
			});
		}else{
				$('#dhen').addClass('hidden');
				$("#hensalario").val("");
				$("#horasen").val("");
		}

		if (document.getElementById('axt').checked){
			$('#daxt').removeClass('hidden');
		    if (Number($("#sueldo").val())<=Number($("#salariomin").val())*2) {
					document.getElementById("auxtrans").value=number_format(($("#auxtransporte").val()/30)*$("#diast").val(),0);
			}else{
				document.getElementById("auxtrans").value="0";
			}
		}else{
				$('#daxt').addClass('hidden');
				$("#auxtrans").val("");
		}

		if (document.getElementById('axc').checked){
			$('#daxc').removeClass('hidden'); 
			$("#auxcom").val(number_format(($("#comida").val()*$("#diast").val()),0));
		}else{
				$('#daxc').addClass('hidden');
				$("#auxcom").val("");
		}
	}, 100);	
	
	$(document).on('change', '#empleado',event => {
		document.getElementById("diast").value="";
		document.getElementById("salario").value="";
		document.getElementById("sueldo").value="";
		$.get(`/nomina/index/${event.target.value}`, function(res, sta){
			document.getElementById("sueldo").value=res.salario_cargo;
		});
	});
function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}
</script>
@endsection