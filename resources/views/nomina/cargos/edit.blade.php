@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cargo: {{ $cargo->nombre_cargo}}</h3>
			{!!Form::model($cargo,['method'=>'PATCH','route'=>['cargos.update',$cargo->idCargos]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" value="{{$cargo->nombre_cargo}}" placeholder="Nombre...">
			</div>
			<div class="form-group">
				<label for="salario">Salario</label>
				<input type="text" name="salario" id="salario" class="form-control" value="{{number_format($cargo->salario_cargo)}}" placeholder="Salario...">
			</div>
			<div class="form-group">
				<label for="color">Color</label>
				<select name="color" class="form-control">
					<option value="1">Rojo</option>
					<option value="2">Rosado</option>
					<option value="3">Morado</option>
					<option value="4">Morado Oscuro</option>
					<option value="5">Indigo</option>
					<option value="6">Azul</option>
					<option value="7">Cian</option>
					<option value="8">Verde azulado</option>
					<option value="9">Verde</option>
					<option value="10">Verde claro</option>
					<option value="11">Lima</option>
					<option value="12">Amarillo</option>
					<option value="13">Ámbar</option>
					<option value="14">Naranja</option>
					<option value="15">Naranja Oscuro</option>
					<option value="16">Marrón</option>
					<option value="17">Gris</option>
					<option value="18">Gris azulado</option>
				</select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/cargos"class="btn btn-danger">Cancelar</a>
			</div>

			{!!Form::close()!!}
			
		</div>
	</div>
	<script>
	setInterval( function() { 
    if( haCambiado() );
}, 100);
	var valueAnterior=document.getElementById("salario").value; 
    function haCambiado() { 

        if(document.getElementById("salario").value!=valueAnterior) { 
            document.getElementById("salario").value= number_format(document.getElementById("salario").value,0); 
            return true; 
        } 
        else  
        return false; 
    }
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