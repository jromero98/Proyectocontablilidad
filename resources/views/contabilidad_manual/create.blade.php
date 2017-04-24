@extends('layouts.admin') @section('contenido')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset('vendor\datatables\js\jquery.dataTables.js')}}"></script>
<div class="col-md-8 col-xs-12">
    <div class="x_panel">
        <div class="page-title">
            <div class="title_left">
                <h3>Contabilidad Manual</h3>
            </div>
        </div>
        <div class="x_content">
            <div class="well">
               {!! Form::open(['url' => 'contabilidad-manual', 'class' => 'form-horizontal', 'id'=>'cl']) !!} {{Form::token()}}
                <div class="form-group">
                    {!! Form::label('fecha', 'Fecha:', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        <div class="input-group date" id="datetimepicker">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            @if(empty($fecha))
                                <input type="text" id="datetimepicker" name="fecha" value="<?php echo date('Y-m-d H:i'); ?>" class="form-control pull-left" required="required">
                            @else
                                <input type="text" id="datetimepicker" name="fecha" value="{{$fecha}}" class="form-control pull-left" required="required">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('nodoc', 'N° Comprobante:', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-2">
                        <select class="form-control" name="tipo_factura" id="tipo_factura">
                           <option value="">Seleccione</option>
                            @foreach($facturas as $factura)
                                   @if(isset($tpfactura))
                                        @if($tpfactura==$factura->Tipo_factura)
                                            <option selected>{{$factura->Tipo_factura}}</option>
                                        @endif
                                    @else
                                    <option>{{$factura->Tipo_factura}}</option>
                                    @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-8">
                        @if(empty($comprobante))
                            {!! Form::text('nodoc', $value = null, ['id'=>'nodoc','class' => 'form-control', 'placeholder' => 'Numero de Factura', 'type'=>'text','required'=>'required']) !!}
                        @else
                            {!! Form::text('nodoc', $value = "$comprobante", ['id'=>'nodoc','class' => 'form-control', 'placeholder' => 'Numero de Factura', 'type'=>'text','required'=>'required','readonly']) !!}
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('desc', 'Descripcion', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        @if(empty($descripcion))
                            {!! Form::textarea('desc', $value = null, ['class' => 'form-control', 'rows' => 3,'required'=>'required']) !!}
                        @else
                            {!! Form::textarea('desc', $value = "$descripcion", ['class' => 'form-control', 'rows' => 3,'required'=>'required']) !!}
                        @endif      
                        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                    </div>
                </div>

                <div class="row test">
                    <div class="col-xs-3">
                        {!! Form::label('cod_cuenta', 'Codigo y Cuenta:') !!}
                    </div>
                    <!--div class="col-xs-3">
                    {!! Form::label('fecha', 'Fecha:', ['class' => 'col-lg-2 control-label']) !!}  
                </div-->
                    <div class="col-xs-3">
                        {!! Form::label('valor', 'Valor:', ['class' => 'col-lg-2 control-label']) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::label('naturaleza', 'Naturaleza', ['class' => 'col-lg-2 control-label'] ) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::label('aux', 'Auxiliar', ['class' => 'col-lg-2 control-label'] ) !!}
                    </div>
                    <!-- Submit Button -->
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <select name="cod_cuenta" id="cod_cuenta" class="form-control selectpicker" data-live-search='true'>
                            @foreach($cuentas as $cuenta)
                            <option value="{{$cuenta->cod_puc}}">{{$cuenta->cod_puc}} {{$cuenta->nom_puc}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-3">
                        {!! Form::text('valor', $value = null, ['class' => 'form-control','id'=>'valor', 'placeholder' => 'valor']) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::select('naturaleza', ['credito' => 'Credito', 'debito' => 'Debito'], 'S', ['id'=>'naturaleza','class' => 'form-control' ]) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::number('auxi', $value = null, ['class' => 'form-control','id'=>'auxi', 'placeholder' => 'Auxiliar']) !!}
                    </div>
                    <div class="col-xs-3">
                       <br>
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
                                <th>Auxliliar</th>
                            </thead>
                            <tbody>
                                @if(!empty($cuent))
                                    @for($i=0; $i < count($cuent); $i++)
                                        <tr class="selected" id="fila{{$i}}">
                                            <td><button type=button class="btn btn-warning" onclick="eliminar({{$i}});">X</button></td>
                                            <td>
                                               @foreach($cuentas as $cuenta)
                                                    @if($cuent[$i]==$cuenta->cod_puc)
                                                        <input type="hidden" name="cuenta[]" value="{{$cuenta->cod_puc}}">{{$cuenta->cod_puc}}  {{$cuenta->nom_puc}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td><input type="text" name="valor[]" value="{{$valores[$i]}}" class="col-lg-10"></td>
                                            <td>
                                                   @if($naturalezas[$i]== "debito")
                                                    <input type="hidden" name="naturaleza[]" value="{{$naturalezas[$i]}}">Debito
                                                    @else
                                                    <input type="hidden" name="naturaleza[]" value="{{$naturalezas[$i]}}">Credito
                                                    @endif
                                            </td>
                                            <td><input type="number" name="auxil[]" value="{{$auxiliarr[$i]}}" class="col-lg-10"></td>
                                        </tr> 
                                    @endfor
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <input type="hidden" value="{{ csrf_token() }}" name="token">
                <div class="container-fluid">
                    {{ Form::submit('Guardar', ['id'=>'guardar','class' => 'btn btn-default btn-lg btn-success pull-left'] ) }}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Auxiliares <small>(Terceros)</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-striped table-bordered table table-condensed table-hover" id="terceros">
                <thead class="thead-inverse">
                    <tr>
                        <th data-field="Codigo">Codigo</th>
                        <th data-field="Nombre">Nombre </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($auxiliar as $aux)
                    <tr>
                        <td>{{$aux->id_aux}}</td>
                        <td>{{$aux->nom_aux}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{asset('js/contabilidad_manual.js')}}"></script>
@endsection