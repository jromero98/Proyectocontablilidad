@extends ('layouts.admin')
@section ('contenido')
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<h3>Nueva Compra</h3>
			</div>
		</div>

		@include('facturacion.compras.ingresarmodal')   
	    {!!Form::open(array('id'=>'formulario1','url'=>'compras','method'=>'POST','autocomplete'=>'off'))!!}
	    {{Form::token()}}
		<div class="row"> 
			<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
				<label form="proveedor">Proveedor</label>
				<select name="idproveedor" id="proveedor" class="form-control selectpicker" data-live-search="true">
					@foreach($personas as $persona)
						<option value="{{$persona->doc_persona}}">{{$persona->doc_persona}}   {{$persona->nombre_persona}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
				<br>
				<a class="btn btn-labeled btn btn-success btn-circle" id="plus" href="" data-target="#modal-ingresar" data-toggle="modal"><i class="fa fa-plus"></i></a>
			</div>        
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="comprobante">Factura de compra N°</label>
					<input type="text" value="{{$factura->cfactura}}" name="comprobante" class="form-control" placeholder="Numero de Comprobante...">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="fecha">Fecha actual</label>
					<input type="date" value="<?php echo date('Y-m-d'); ?>" name="fecha" class="form-control" placeholder="Fecha...">
				</div>
			</div>
		</div>

		<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="from-group">
	                    <label>Articulo</label>
	                    <select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search='true'>
	                        @foreach($articulos as $art)
	                        <option value="{{$art->idArticulos}}">{{$art->idArticulos}} {{$art->nom_articulo}}</option>
	                        @endforeach
	                    </select> 
				    </div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
				<label for="cantidad">Cantidad</label>
					<input type="number"  name="pcantidad" class="form-control" id="pcantidad" placeholder="Cantidad...">
				</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
				<label for="precio_compra">Precio Compra</label>
					<input type="text" name="precio_compra" class="form-control" id="pprecio_compra" placeholder="Precio Compra...">
				</div>
				</div>
				<!--div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
				<label for="precio_venta">Precio Venta</label>
					<input type="text" name="pprecio_venta" class="form-control" id="pprecio_venta" placeholder="Precio Venta...">
				</div>
				</div-->
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
				    <br/>
					<a class="btn btn-labeled btn btn-primary" id="btn_add"><span class="btn-label"><i class="fa fa-plus"></i></span>Agregar</a>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style=" background-color:#A9D0F5 ">
							<th>Opciones</th>
							<th>Articulo</th>
							<th>Cantidad</th>
							<th>Precio Compra</th>
							<!--th>Precio Venta</th-->
							<th>Subtotal</th>
						</thead>
						<tfoot>
							<th>Total</th>
							<th></th>
							<th></th>
							<th></th>
							<!--th></th-->
							<th><h4 id="total">$ 0.00</h4></th>
						</tfoot>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
			</div>
		</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
				<div class="form-group">
					<input type="hidden" value="{{ csrf_token() }}" name="token">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<a href="/compras" class="btn btn-danger">Cancelar</a>
				</div>
			</div>
		</div>
{!!Form::close()!!}
<script type="">
	$(document).ready(function(){
		$('#btn_add').click(function(){
			agregar();
		});
	});
	var cont=0;
	total=0;
	subtotal=[];
	$("#guardar").hide();
    
	function agregar(){
		idarticulo=$("#pidarticulo").val();
		articulo=$("#pidarticulo option:selected").text();
		cantidad=$("#pcantidad").val();
		precio_compra=$("#pprecio_compra").val();
		precio_venta=$("#pprecio_venta").val();
	if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_compra!=""){
       subtotal[cont]=cantidad*parseFloat(precio_compra.replace(",",""));
       total+=subtotal[cont];
			
			var fila='<tr class="selected" id="fila'+cont+'"><td><button type=button class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="text" name="precio_compra[]" value="'+precio_compra+'"></td><!--td><input type="text" name="precio_venta[]" value="'+precio_venta+'"></td--><td>'+number_format(subtotal[cont],0)+'</td></tr>';
			cont++;
			limpiar();
			$('#total').html("$. " + number_format(total,0));
			evaluar();
			$('#detalles').append(fila);
		}else{
			alert("Error al ingresar el detalle del ingreso, revise los datos del articulo");
		}
	}
	function limpiar(){
		$("#pcantidad").val("");
		$("#pprecio_compra").val("");
		$("#pprecio_venta").val("");
	}
	function evaluar(){
		if (total>0) {
			$("#guardar").show();
		}else{
			$("#guardar").hide();
		}
	}
	function eliminar(index){
      total=total-subtotal[index]; 
      $("#total").html("$. " + number_format(total,0));   
      $("#fila" + index).remove();
      evaluar();
  }
setInterval( function() { 
    //if( haCambiado() );
    if( haCambiado2() );
}, 100);
    // var valueAnterior=document.getElementById("pprecio_venta").value; 
    // function haCambiado() { 
    //     if(document.getElementById("pprecio_venta").value!=valueAnterior) { 
    //         document.getElementById("pprecio_venta").value= number_format(document.getElementById("pprecio_venta").value,0); 
    //         return true; 
    //     } 
    //     else  
    //     return false; 
    // } 
    var valueAnterior=document.getElementById("pprecio_compra").value; 
    function haCambiado2() { 
        if(document.getElementById("pprecio_compra").value!=valueAnterior) { 
            document.getElementById("pprecio_compra").value= number_format(document.getElementById("pprecio_compra").value,0); 
            return true; 
        } 
        else  
        return false; 
    } 
 function cargarp(){
 	$(document).ready(function(){
		$.get(`/persona/index`, function(res, sta){
		$("#idproveedor").change(function(){
            alert($('select[id=idproveedor]').val());
		});
				$("#idproveedor").empty();
				res.forEach(element => {
					$("#idproveedor").append(`<option value=${element.doc_persona}>${element.doc_persona} ${element.nombre_persona}</option>`);
				});
		});
	});
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