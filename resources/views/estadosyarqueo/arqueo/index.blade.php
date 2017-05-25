@extends('layouts.admin')
@section('contenido')
<div class="row" style="background-color:#CBFF48;">
<br>
	<div class="col-xs-12" style="text-align:center">
		<h3>Arqueo de Caja</h3>
		<br>
	</div>
</div>
<?php $efectivo=0; ?>

			@foreach($estadosd as $estadod)
				@if($estadod->clase_puc==1)
			        <?php $efectivo+=$estadod->valor; ?>
			    @endif
			@endforeach

			@foreach($estadosc as $estadoc)
				@if($estadod->clase_puc==1)
			        <?php $efectivo+=$estadod->valor; ?>
			    @endif
			@endforeach
<div class="row">
{!!Form::open(array('url'=>'arqueo','method'=>'POST','autocomplete'=>'off'))!!}
	    {{Form::token()}}
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
			<label >Efectivo Sistema</label>
			<input type="text" readonly="" class="form-control" value="{{number_format($efectivo)}}" name="efectivop">
			<label >Efectivo Caja</label>
			<input type="number" class="form-control" value="" name="efectivo">
		</div>
		<button class="btn btn-primary"> Evaluar </button>
	</div>
	{!!Form::close()!!}
</div>
@endsection