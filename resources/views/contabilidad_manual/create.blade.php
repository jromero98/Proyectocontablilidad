@extends('layouts.admin')
@section('contenido')
<div class="page-title">
    <div class="title_left">
                <h3>Contabilidad Manual</h3>
    </div>
</div>
   
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      
<div class="well">
     @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
    {!! Form::open(['url' => 'contabilidad-manual', 'class' => 'form-horizontal', 'id'=>'cl']) !!}
    {{Form::token()}}        
        <div class="form-group">
        {!! Form::label('fecha', 'Fecha:', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                <div class="input-group date" id="datetimepicker">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" class="form-control pull-left" required="required">
                </div>
            </div>
        </div>
        
        <div class="form-group">
            {!! Form::label('nodoc', 'N° Comprobante:', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('nodoc', $value = null, ['class' => 'form-control', 'placeholder' => 'Ej:Fv001', 'type'=>'text','required'=>'required']) !!}
            </div>
        </div>
        
        <div class="form-group">
            {!! Form::label('desc', 'Descripcion', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::textarea('desc', $value = null, ['class' => 'form-control', 'rows' => 3,'required'=>'required']) !!}
                <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
            </div>
        </div>
        
        <div class="row test">
                <div class="col-xs-4">
                    {!! Form::label('cod_cuenta', 'Codigo y Cuenta:') !!}  
                </div>
                <!--div class="col-xs-3">
                    {!! Form::label('fecha', 'Fecha:', ['class' => 'col-lg-2 control-label']) !!}  
                </div-->
                <div class="col-xs-3">
                    {!! Form::label('valor', 'Valor:', ['class' => 'col-lg-2 control-label']) !!} 
                </div>
                <div class="col-xs-3">
                    {!! Form::label('naturaleza', 'Naturaleza', ['class' => 'col-lg-2 control-label'] )  !!} 
                </div>
        <!-- Submit Button -->
        </div>
        
        <div class="row">
            <div class="col-xs-4">
                <select name="cod_cuenta" id="cod_cuenta" class="form-control selectpicker"  data-live-search='true'>
					@foreach($cuentas as $cuenta)
				        <option value="{{$cuenta->cod_puc}}">{{$cuenta->cod_puc}} {{$cuenta->nom_puc}}</option>
                    @endforeach
				</select>
            </div>
            <div class="col-xs-3">
                {!! Form::number('valor', $value = null, ['class' => 'form-control','id'=>'valor', 'placeholder' => 'valor']) !!}
            </div>
            <div class="col-xs-3">
                {!!  Form::select('naturaleza', ['credito' => 'Credito', 'debito' => 'Debito'],  'S', ['id'=>'naturaleza','class' => 'form-control' ]) !!}
            </div>
            <div class="form-group">
				<button type="button" id="btn_add" class="btn btn-primary">Agregar</button>
			</div>
        </div>
        
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table id="detallescuentas" class="table table-striped table-bordered table-condensed table-hover">
					<thead style=" background-color:#A9D0F5 ">
						<th>Opciones</th>
						<th>Codigo y Cuenta</th>
						<th>Valor</th>
						<th>Naturaleza</th>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
        <input type="hidden" value="{{ csrf_token() }}" name="token">
        <div class="container-fluid">
            {{ Form::submit('Guardar', ['class' => 'btn btn-default btn-lg btn-success pull-left'] ) }}
        </div>
        
    {!! Form::close()  !!}
</div>
<script>
	$(document).ready(function(){
	$('#btn_add').click(function(){
		agregar();
		});
	});
	function agregar(){
        var cont=0;
        vpuc=$("#cod_cuenta option:selected").val();
		cpuc=$("#cod_cuenta option:selected").text();
		valor=$("#valor").val();
		naturale=$("#naturaleza option:selected").val();
		naturalez=$("#naturaleza option:selected").text();
	if (valor!=""){
			var fila='<tr class="selected" id="fila'+cont+'"><td><button type=button class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="cuenta[]" value="'+vpuc+'">'+cpuc+'</td><td><input type="number" name="valor[]" value="'+valor+'" readonly></td><td><input type="hidden" name="naturaleza[]" value="'+naturale+'">'+naturalez+'</tr>';
			cont++;
            limpiar();
            $('#detallescuentas').append(fila);
		}else{
			alert("Error al ingresar la Cuenta, revise los datos de la cuenta");
		}
	}
	function limpiar(){
		$("#valor").val("");
	}
	function eliminar(index){   
      $("#fila" + index).remove();
  }

</script>
@endsection