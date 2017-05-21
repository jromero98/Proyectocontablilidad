@extends ('layouts.admin')
@section ('contenido')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<style type="text/css">
	.table th{
		text-align: center;
		background-color:#A9D0F5;
	}
	.table td{
		text-align: center;
	}
</style>
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
						<input type="checkbox" name="hed"  id="hed"> Horas Extras Diurnas
					</div>
					<div class="col-md-3">
						<input type="checkbox" name="hen" id="hen"> Horas Extras Nocturnas
					</div>
					<div class="col-md-3">
						<input type="checkbox" name="axt" id="axt"> Auxilio de Transporte
					</div>
					<div class="col-md-3">
						<input type="checkbox" name="axc" id="axc"> Auxilio de Alimentos
					</div>
					<div class="col-md-6 text-center">
						<input type="checkbox" name="boni" id="boni"> Bonificaciones
					</div>
					<div class="col-md-6 text-center">
						<input type="checkbox" name="comi" id="comi"> Comisiones
					</div>

					<table id="Devengados" border="" class="table table-striped table-bordered">
						<th colspan="3" class="text-center"> Devengados </th>
						<tr id="dhed">
							<th class="col-md-2">Horas Extras Diurnas</th>
							<td><input type="number" class="form-control" name="horased" id="horased" placeholder="Horas extas Diurnas"></td>
							<td><input type="text" class="form-control" name="hedsalario" id="hedsalario" readonly="" placeholder="Valor"></td>
						</tr>
						<tr id="dhen">
							<th class="col-md-2">Horas Extras Nocturnas</th>
							<td><input type="number" class="form-control" name="horasen" id="horasen" placeholder="Horas extas Nocturnas"></td>
							<td><input type="text" class="form-control" name="hensalario" id="hensalario" readonly="" placeholder="Valor"></td>
						</tr>
						<tr id="daxt">
							<th  class="col-md-2">Auxilio Transporte</th>
							<td COLSPAN=2><input type="text" class="form-control" name="auxtrans" id="auxtrans" readonly="" placeholder="Auxilio de transporte"></td>
						</tr>
						<tr id="daxc">
							<th class="col-md-2">Auxilio Comida</th>
							<td COLSPAN=2><input type="text" class="form-control" name="auxcom" id="auxcom" readonly="" placeholder="Auxilio de comida"></td>
						</tr>
						<tr id="bonis">
							<th class="col-md-2">Bonificaciones</th>
							<td COLSPAN=2><input type="text" class="form-control" name="bonificacion" id="bonificacion" placeholder="Auxilio de comida"></td>
						</tr>
						<tr id="comis">
							<th class="col-md-2">Comisiones</th>
							<td COLSPAN=2><input type="text" class="form-control" name="comision" id="comision" placeholder="Auxilio de comida"></td>
						</tr>
						<tr>
							<th class="col-md-2">Total Devengado</th>
							<td COLSPAN=2><input type="text" class="form-control text-right" name="tdevengado" id="tdevengado" readonly="" placeholder="Total Devengado"></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-body">
					<table id="Deducibles" border="" class="table table-striped table-bordered">
						<th colspan="3" class="text-center"> Deducibles </th>
						<tr>
							<th class="col-md-2">Aporte EPS</th>
							<td colspan="2"><input type="text" class="form-control" name="aeps" id="aeps" readonly="" placeholder="Valor"></td>
						</tr>
						<tr>
							<th class="col-md-2">Aporte Fondo de Pension</th>
							<td colspan="2"><input type="text" class="form-control" name="afp" id="afp" readonly="" placeholder="Valor"></td>
						</tr>
						<tr>
							<th class="col-md-2">Aporte Fondo de Empleados</th>
							<td class="col-md-3"><input type="checkbox" id="chafe"></td>
							<td><input type="text" class="form-control" name="afe" id="afe" readonly="" placeholder="Aporte Fondo de empleados"></td>
						</tr>
						<tr>
							<th class="col-md-2">Libranza</th>
							<td COLSPAN=2><input type="text" class="form-control" name="libranza" id="libranza" placeholder="Libranza"></td>
						</tr>
						<tr id="daxc">
							<th class="col-md-2" title="Denuncias y demás">Embargos</th>
							<td COLSPAN=2><input type="text" class="form-control" name="embargos" id="embargos" placeholder="Embargos"></td>
						</tr>
						<tr id="daxc">
							<th class="col-md-2">Retencion de la Fuente</th>
							<td COLSPAN=2><input type="text" class="form-control" name="retencionfuente" id="retencionfuente" readonly="" placeholder="Retencion de la Fuente"></td>
						</tr>
						<tr>
							<th class="col-md-2">Total Deducido</th>
							<td COLSPAN=2><input type="text" class="form-control text-right" name="tdeducido" id="tdeducido" readonly="" placeholder="Total Deducido"></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="col-xs-12 text-right row">
			<div class="form-group">
				<div class="col-xs-8 text-right row">
					<div class="form-group">
						<label style="padding: 8px">Total a pagar $</label>
					</div>
				</div>
				<div class="col-xs-4 row">
					<div class="form-group">
						<input type="text" class="form-control" readonly="" id="total">
					</div>
				</div>
			</div>
		</div>
		<input type="text" id="sueldo" name="sueldo" class="hidden">
		<input type="text" id="salariomin" value="{{$calculo->salariominimo}}" class="hidden">
		<input type="text" id="auxtransporte" value="83140" class="hidden">
		<input type="text" id="comida" value="{{$calculo->auxcomida}}" class="hidden">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group row">
				<div class="form-group">
					<input type="hidden" value="{{ csrf_token() }}" name="token">
					<button class="btn btn-primary hidden" type="submit" id="guardar">Guardar</button>
					<a href="/nomina" class="btn btn-danger">Cancelar</a>
				</div>
		</div>
{!!Form::close()!!}
<script>
	var totall=0;
	$(document).on('keyup', '#diast',event => {
		$("#salario").val(number_format(($("#sueldo").val()/30)*$("#diast").val()),0);
	});
	setInterval( function() { 
		var totald=0;
		totall=Number(($("#sueldo").val()/30)*$("#diast").val());
		if($("#auxcom").val()!="")totall+=Number($("#comida").val()*$("#diast").val());
		if($("#auxtrans").val()!="")totall+=Number(parseFloat($("#auxtrans").val().replace(",","")));
		if($("#hedsalario").val()!="")totall+=Number($("#sueldo").val()*1.25*$("#horased").val()/240);
		if($("#hensalario").val()!="")totall+=Number($("#sueldo").val()*1.75*$("#horasen").val()/240);
		if($("#bonificacion").val()!="")totall+=Number(parseFloat($("#bonificacion").val().replace(",","")));
		if($("#comision").val()!="")totall+=Number(parseFloat($("#comision").val().replace(",","")));

		if($("#afe").val()!="")totald+=Number(parseFloat($("#afe").val().replace(",","")));
		if($("#afp").val()!="")totald+=Number(parseFloat($("#afp").val().replace(",","")));
		if($("#aeps").val()!="")totald+=Number(parseFloat($("#aeps").val().replace(",","")));
		if($("#libranza").val()!=""){
			totald+=Number(parseFloat($("#libranza").val().replace(",","").replace(",","")));
			$("#libranza").val(number_format($("#libranza").val()));
		}
		if($("#embargos").val()!=""){
			totald+=Number(parseFloat($("#embargos").val().replace(",","").replace(",","")));
			$("#embargos").val(number_format($("#embargos").val()))
		}
		if($("#retencionfuente").val()!="")totald+=Number(parseFloat($("#retencionfuente").val().replace(",","").replace(",","")));

		if(totall>0){
			$('#guardar').removeClass('hidden');
		}else{
			$('#guardar').addClass('hidden');
		}

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
			$("#aeps").val(number_format((Number(totall)-Number(parseFloat($("#auxtrans").val().replace(",",""))))*0.04,0));
			$("#afp").val(number_format((Number(totall)-Number(parseFloat($("#auxtrans").val().replace(",",""))))*0.04,0));
		}else{
				$('#daxt').addClass('hidden');
				$("#auxtrans").val("");
				$("#aeps").val(number_format(Number(totall)*0.04,0));
				$("#afp").val(number_format(Number(totall)*0.04,0));
		}

		if (document.getElementById('axc').checked){
			$('#daxc').removeClass('hidden'); 
			$("#auxcom").val(number_format(($("#comida").val()*$("#diast").val()),0));
		}else{
				$('#daxc').addClass('hidden');
				$("#auxcom").val("");
		}	
		if (document.getElementById('boni').checked){
			$('#bonis').removeClass('hidden'); 
			$("#bonificacion").val(number_format(($("#bonificacion").val()),0));
		}else{
				$('#bonis').addClass('hidden');
				$("#bonificacion").val("");
		}	
		if (document.getElementById('comi').checked){
			$('#comis').removeClass('hidden'); 
			$("#comision").val(number_format(($("#comision").val()),0));
		}else{
				$('#comis').addClass('hidden');
				$("#auxcom").val("");
		}			
		if($("#empleado option:selected").val()!=""){
			$.get('/nomina/deducibles/'+$("#empleado option:selected").val(), function(res, sta){

			var retencion=totall;
			if ($("#diast").val()!="") {
				retencion=retencion-Number(parseFloat($("#aeps").val().replace(",","")));
				res.forEach(element => {
				if ((($("#sueldo").val()/30)*$("#diast").val())/{{$calculo->UVT}}>95) {
					if (element.iddeduccionempleado==1) {
						if(Number(parseFloat({{$calculo->UVT}}*32)) > Number(parseFloat(totall*0.10))){
							retencion=retencion-Number(parseFloat(totall*0.10));
						}else{
							retencion=retencion-({{$calculo->UVT}}*32);
						}
					}
					if (element.iddeduccionempleado==2) {
						if(Number(parseFloat({{$calculo->UVT}}*16)) > Number(parseFloat(element.valordeduccion))){
							retencion=retencion-Number(parseFloat(element.valordeduccion));
						}else{
							retencion=retencion-Number(parseFloat({{$calculo->UVT}}*16));
						}
					}
					if (element.iddeduccionempleado==3) {
						if(Number(parseFloat({{$calculo->UVT}}*3800)) > Number(parseFloat(element.valordeduccion))*12){
							retencion=retencion-Number(parseFloat(element.valordeduccion));
						}else{
							retencion=retencion-Number(parseFloat({{$calculo->UVT}}*3800));
						}
					}
					if (element.iddeduccionempleado==4) {
						if(Number(parseFloat({{$calculo->UVT}}*100)) > Number(parseFloat(element.valordeduccion))){
							retencion=retencion-(Number(parseFloat(element.valordeduccion)));
						}else{
							retencion=retencion-Number(parseFloat({{$calculo->UVT}}*100));
						}
					}
				}
				if (element.iddeduccionempleado==5) {

							console.log(Number(totall)*(element.valordeduccion/100));
					if (document.getElementById('chafe').checked){
							console.log(Number(totall)*(element.valordeduccion/100));
							$("#afe").val(number_format(Number(totall)*(element.valordeduccion/100)),0);
					}else{
							$("#afe").val("");
					}
				}else{
					if (document.getElementById('chafe').checked){
							$("#afe").val(number_format(Number(totall)*0.01),0);
					}else{
							$("#afe").val("");
					}
				}
			});
			if(Number(parseFloat({{$calculo->UVT}}*240)) > (retencion*0.25)){
				retencion=retencion-(retencion*0.25);
			}else{
				retencion=retencion-Number(parseFloat({{$calculo->UVT}}*240));
			}
			var cuvt=retencion/({{$calculo->UVT}});
			if (cuvt>95&&cuvt<151) {
				totald+=((cuvt-95)*0.19)*({{$calculo->UVT}});
				$("#retencionfuente").val(number_format(((cuvt-95)*0.19)*{{$calculo->UVT}},0));
			}
			if (cuvt>150&&cuvt<361) {
				totald+=(((cuvt-150)*0.28)+10)*({{$calculo->UVT}});
				$("#retencionfuente").val(number_format((((cuvt-150)*0.28)+10)*{{$calculo->UVT}},0));
			}
			if (cuvt>360) {
				totald+=(((cuvt-360)*0.33)+69)*({{$calculo->UVT}});
				$("#retencionfuente").val(number_format((((cuvt-360)*0.33)+69)*{{$calculo->UVT}},0));
			}
			}else{
				$("#retencionfuente").val("");
			}
			});
		}

		$("#tdevengado").val(number_format(totall,0));
		$("#tdeducido").val(number_format(totald,0));
		$("#total").val(number_format(totall-totald,0));
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