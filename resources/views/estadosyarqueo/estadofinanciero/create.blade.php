@extends('layouts.admin')
@section('contenido')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link href="{{asset('css/daterangepicker.css')}}" rel="stylesheet">
<div class="row">
	<div class="col-xs-12 text-center" style="background-color:#CBFF48;" >
     <h3>{{$vivero->nom_vivero}}</h3>
      <h3>Estados Financieros</h3>
      <br>
		    <div class="col-lg-5">
                <div class="input-group date" id="datetimepicker">
                     <div class="input-group-addon">
                         <i class="fa fa-calendar"></i>
                     </div>
                     @if(empty($fecha))
                         <input type="text" id="datetimepicker" name="fechainicio" class="form-control" required="required">
                     @else
                         <input type="text" id="datetimepicker" name="fechainicio" value="{{$fecha}}" class="form-control" required="required">
                     @endif
                 </div>
             </div>
             <div class="col-lg-2">    
                 <h3 style="margin: 1px "> a </h3>
             </div>
		    <div class="col-lg-5">
		        <div class="input-group date" id="datetimepicker2">
                     <div class="input-group-addon">
                         <i class="fa fa-calendar"></i>
                     </div>
                     @if(empty($fecha))
                         <input type="text" id="datetimepicker2" name="fechafin" class="form-control" required="required">
                     @else
                         <input type="text" id="datetimepicker2" name="fechafin" value="{{$fecha}}" class="form-control" required="required">
                     @endif
                 </div>  
       </div>
       
        <h4>Expresado en pesos</h4>	  
       <button class="btn btn-success" id=mostrar>Generar</button>
       <br> <br>
       
	</div>
	

</div>
<br> <br>
<?php $activos=0; $patrimonios=0; ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="display table hidden" id="estadoresultado">
				<tbody>
				
						<tr>
                            <td colspan="2"><strong>ACTIVO</strong></td>
                        </tr>
                        <tr>
							<td colspan="2"><strong>ACTIVOS CORRIENTES</strong></td>
                        </tr>
                        @foreach($estadosd as $estadod)
                            @if($estadod->naturaleza_puc=="C"&&$estadod->clase_puc==1)
                            <?php $activos+=$estadod->valor ?>
                            <tr>
                                <td>{{$estadod->nom_puc}}</td>
                                <td>{{number_format($estadod->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
                        @foreach($estadosc as $estadoc)
                            @if($estadoc->naturaleza_puc=="C"&&$estadoc->clase_puc==1&&$estadoc->valor!=0)
                            <?php $activos+=(-$estadoc->valor) ?>
                            <tr>
                                <td>{{$estadoc->nom_puc}}</td>
                                <td>-{{number_format($estadoc->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="2"><strong>ACTIVOS NO CORRIENTES</strong></td>
                        </tr>
                            @foreach($estadosd as $estadod)
                            @if($estadod->naturaleza_puc=="N"&&$estadod->clase_puc==1)
                            <?php $activos+=$estadod->valor ?>
                            <tr>
                                <td>{{$estadod->nom_puc}}</td>
                                <td>{{number_format($estadod->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
                        @foreach($estadosc as $estadoc)
                            @if($estadoc->naturaleza_puc=="N"&&$estadoc->clase_puc==1&&$estadoc->valor!=0)
                            <?php $activos+=(-$estadoc->valor) ?>
                            <tr>
                                <td>{{$estadoc->nom_puc}}</td>
                                <td>-{{number_format($estadoc->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="2"><strong>OTROS ACTIVOS</strong></td>
                        </tr>
                        @foreach($estadosd as $estadod)
                            @if($estadod->naturaleza_puc=="U"&&$estadod->clase_puc=="1")
                            <?php $activos+=$estadod->valor ?>
                            <tr>
                                <td>{{$estadod->nom_puc}}</td>
                                <td>{{number_format($estadod->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
                        @foreach($estadosc as $estadoc)
                            @if($estadoc->naturaleza_puc=="U"&&$estadoc->clase_puc==1&&$estadoc->valor!=0)
                            <?php $activos+=(-$estadoc->valor) ?>
                            <tr>
                                <td>{{$estadoc->nom_puc}}</td>
                                <td>-{{number_format($estadoc->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
						<tr>
							<td colspan="2"><strong>PASIVO</strong></td>
						</tr>
                        <tr>
                            <td colspan="2"><strong>PASIVOS CORRIENTES</strong></td>
                        </tr>
                        @foreach($estadosd as $estadod)
                            @if($estadod->naturaleza_puc=="C"&&$estadod->clase_puc=="2")
                            <?php $patrimonios+=(-$estadod->valor) ?>
                            <tr>
                                <td>{{$estadod->nom_puc}}</td>
                                <td>-{{number_format($estadod->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
                        @foreach($estadosc as $estadoc)
                            @if($estadoc->naturaleza_puc=="C"&&$estadoc->clase_puc==2&&$estadoc->valor!=0)
                            <?php $patrimonios+=($estadoc->valor) ?>
                            <tr>
                                <td>{{$estadoc->nom_puc}}</td>
                                <td>{{number_format($estadoc->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="2"><strong>PASIVOS NO CORRIENTES</strong></td>
                        </tr>
                        @foreach($estadosd as $estadod)
                            @if($estadod->naturaleza_puc=="N"&&$estadod->clase_puc=="2")
                            <?php $patrimonios+=(-$estadod->valor) ?>
                            <tr>
                                <td>{{$estadod->nom_puc}}</td>
                                <td>-{{number_format($estadod->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
                        @foreach($estadosc as $estadoc)
                            @if($estadoc->naturaleza_puc=="N"&&$estadoc->clase_puc==2&&$estadoc->valor!=0)
                            <?php $patrimonios+=($estadoc->valor) ?>
                            <tr>
                                <td>{{$estadoc->nom_puc}}</td>
                                <td>{{number_format($estadoc->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="2"><strong>OTROS PASIVOS</strong></td>
                        </tr>
                        @foreach($estadosd as $estadod)
                            @if($estadod->naturaleza_puc=="U"&&$estadod->clase_puc=="2")
                            <?php $patrimonios+=(-$estadod->valor) ?>
                            <tr>
                                <td>{{$estadod->nom_puc}}</td>
                                <td>-{{number_format($estadod->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
                        @foreach($estadosc as $estadoc)
                            @if($estadoc->naturaleza_puc=="U"&&$estadoc->clase_puc==2&&$estadoc->valor!=0)
                            <?php $patrimonios+=($estadoc->valor) ?>
                            <tr>
                                <td>{{$estadoc->nom_puc}}</td>
                                <td>{{number_format($estadoc->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
						<tr>
							<td colspan="2"><strong>PATRIMONIO</strong></td>
						</tr>
                        @foreach($estadosd as $estadod)
                            @if($estadod->clase_puc=="3")
                            <?php $patrimonios+=(-$estadod->valor) ?>
                            <tr>
                                <td>{{$estadod->nom_puc}}</td>
                                <td>-{{number_format($estadod->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
                        @foreach($estadosc as $estadoc)
                            @if($estadoc->clase_puc==3&&$estadoc->valor!=0)
                            <?php $patrimonios+=($estadoc->valor) ?>
                            <tr>
                                <td>{{$estadoc->nom_puc}}</td>
                                <td>{{number_format($estadoc->valor)}}</td>
                            </tr>
                            @endif
                        @endforeach
						<tr>
                            <td><strong>Activos</strong></td>
                            <td>{{number_format($activos)}}</td>
                        </tr>
                        <tr>
							<td><strong>Patrimono + Pasivos</strong></td>
                            <td>{{number_format($patrimonios)}}</td>
						</tr>
				</tbody>
			</table>
		</div>
	</div>
		<div class="form-group text-center">
			<a class="btn btn-primary hidden" type="submit" id="genera"  href="#">Guardar</a>
		</div>
</div>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
		$(function () {
            $("#datetimepicker").datetimepicker({format:'DD/MM/YYYY'});
        });
        $(function () {
            $("#datetimepicker2").datetimepicker({format:'DD/MM/YYYY'});
        });
         $('#mostrar').click(function () {
            
            	$("#estadoresultado").removeClass('hidden');
            	$("#generar").removeClass('hidden');
            }
            );
} );
</script>
@endsection