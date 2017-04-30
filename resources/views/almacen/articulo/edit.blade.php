@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Articulo: {{ $articulo->nom_articulo}}</h3>
		</div>
	</div>
			{!!Form::model($articulo,['method'=>'PATCH','route'=>['articulo.update',$articulo->idArticulos],'files'=>true])!!}
			{{Form::token()}}
			<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
				<label for="codigo">Codigo del Articulo</label>
				<input type="text" name="codigo" required value="{{$articulo->idArticulos}}" class="form-control" >
				<input type="text" name="rcodigo" required value="{{$articulo->idArticulos}}" class="form-control hidden" readonly>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" required value="{{$articulo->nom_articulo}}" name="nombre" class="form-control">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<label>Categoria</label>
			<select name="idcategoria" class="form-control">
				@foreach($categorias as $cat)
					@if($cat->idcategoria==$articulo->idcategoria)
					<option value="{{$cat->idCategorias}}" selected> {{$cat->Nombre_categoria}}</option>
					@else
					<option value="{{$cat->idCategorias}}">{{$cat->Nombre_categoria}}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="stock">Stock</label>
				<input type="text" required value="{{$articulo->stock}}" name="stock" class="form-control">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="minimo">Minimo</label>
				<input type="text" required value="{{$articulo->minimo}}" name="minimo" class="form-control" placeholder="Minimo...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="maximo">Maximo</label>
				<input type="text" required value="{{$articulo->maximo}}" name="maximo" class="form-control" placeholder="Maximo...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="preciov">Precio de venta</label>
				<input type="text" required value="{{number_format($articulo->Precio_venta)}}" name="preciov" id="preciov" class="form-control" placeholder="Precio de venta...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="preciop">Precio Promedio</label>
				<input type="text" value="{{number_format($promedio)}}" name="preciop" readonly="" class="form-control" placeholder="Precio Promedio...">
			</div>
		</div>
	</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/almacen/articulo"class="btn btn-danger">Cancelar</a>
			</div>
			{!!Form::close()!!}
<script>
	setInterval( function() { 
    if( haCambiado() );
}, 100);
	var valueAnterior=document.getElementById("preciov").value; 
    function haCambiado() { 

        if(document.getElementById("preciov").value!=valueAnterior) { 
            document.getElementById("preciov").value= number_format(document.getElementById("preciov").value,0); 
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