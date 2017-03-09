@extends('layouts.admin')
@section('contenido')
<div class="page-title">
    <div class="title_left">
                <h3>Contabilidad Manual</h3>
    </div>
</div>

<div class="well">
 
    {!! Form::open(['url' => 'contabilidad-manual', 'class' => 'form-horizontal', 'id'=>'cl']) !!}
    {{Form::token()}}        
        <div class="form-group">
        {!! Form::label('fecha', 'Fecha:', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                <div class="input-group date" id="datetimepicker">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" id="datepicker" class="form-control pull-left" required="required">
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
        
           @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
        
        <div class="row test">
                <div class="col-xs-3">
                    {!! Form::label('cod_cuenta', 'Codigo:', ['class' => 'col-lg-2 control-label']) !!}  
                </div>
                <div class="col-xs-3">
                    {!! Form::label('cuenta', 'Cuenta:', ['class' => 'col-lg-2 control-label']) !!}  
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
            <div class="col-xs-3">
                <select name="cod_cuenta[]" class="form-control selectpicker" onchange="MostrarCuenta(this.id);" id="cod_cuenta" data-live-search='true'>
					@foreach($cuentas as $cuenta)
				        <option value="{{$cuenta->cod_puc}}">{{$cuenta->cod_puc}}</option>
                    @endforeach
				</select>
            </div>
               <div class="col-xs-3">
               <?php $cont=0; ?>
                @foreach($cuentas as $cuenta)
                   @if ($cont==0)
                        {!! Form::text('cuenta[]', $value = $cuenta->nom_puc, ['id' => 'cuenta', 'class' => 'form-control','readonly', 'type'=>'text']) !!}
                    @endif
				  <?php $cont++; ?>
               @endforeach
                
            </div>
            <!--div class="col-xs-3">
                <input type="date" name="fecha[]" value="<?php echo date('Y-m-d'); ?>" class="form-control" />
            </div-->
            <div class="col-xs-3">
                {!! Form::text('valor[]', $value = null, ['class' => 'form-control', 'placeholder' => 'valor', 'type'=>'text']) !!}
            </div>
            <div class="col-xs-3">
                {!!  Form::select('naturaleza[]', ['credito' => 'Credito', 'debito' => 'Debito'],  'S', ['class' => 'form-control' ]) !!}
            </div>
        </div>
        
       <input type="button" value="+ Agregar" class="btn-link" />
        <div class="container-fluid">
            {{ Form::submit('Enviar', ['class' => 'btn btn-default btn-lg btn-success pull-left'] ) }}
            {{ Form::reset('Limpiar', ['class' => 'btn btn-lg btn-warning form-button pull-left ']) }}
        </div>
        
    {!! Form::close()  !!}
</div>
<script type = "text/javascript">
    $(document).ready(function() {
        $('.btn-link').click(function(){
            //we select the box clone it and insert it after the box
            $('.row:last').clone().insertAfter(".row:last");
        });
    });
    
    $( function() {
        $( "#datepicker" ).datepicker();
    } );
        
    function MostrarCuenta(id){
       var CuentaSel = document.getElementById(id);
       var CuentaActual = document.getElementById('cuenta');
        CuentaActual.value =CuentaActual
            
    }
        
    function calcular_total() {
        importe_total = 0
        $(".importe_linea").each(
            function(index, value) {
                importe_total = importe_total + eval($(this).val());
            }
        );
        $("#total").val(importe_total);
    }
 
    function nueva_linea() {
        $("#lineas").append('<input type="text" class="importe_linea" value="0"/><br/>');
    }
</script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endsection