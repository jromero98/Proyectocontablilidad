@extends('layouts.admin')
@section('contenido')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link href="{{asset('css/daterangepicker.css')}}" rel="stylesheet">
<div class="row">
	<div class="col-xs-12 text-center" style="background-color:#CBFF48;" >
        <br> 
         <h3>{{$vivero->Nom_vivero}}</h3>
          <h3>Estado de resultados</h3>
          
        <h3 for="">{{$estadosresultados->fechainicio}} A {{$estadosresultados->fechafin}}</h3>
            <br>
    </div>
            
       <br> <br>
       
	</div>
	

</div>
<br> <br>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="display table table-bordered" id="estadoresultado">
				<thead>
					<th></th>
					<th>Total</th>
				</thead>
				<tbody>
					<tbody>
                        <tr>
                            <td><strong>VENTAS</strong></td>
                            <td>{{number_format($venta->venta)}}</td>
                        </tr>
                        <tr>
                            <td>   Devoluciones y descuentos</td>
                            <td>{{number_format($s1)}}</td>
                        </tr>
                        <tr>
                            <td><strong>    VENTAS TOTALES</strong></td>
                            <td>{{number_format($venta->venta-$s1)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>INGRESOS OPERACIONALES</strong></td>
                        </tr>
                        <tr>
                            <td>Costo de ventas</td>
                             <td>{{number_format($s2)}}</td>
                        </tr>
                        <tr>
                            <td><strong>UTILIDAD BRUTA </strong></td>
                            <td>{{number_format($venta->venta-$s1-$s2)}}</td>
                        </tr>
                        <tr>
                            <td>Gastos operacionales de ventas</td>
                            <td> {{number_format($s3)}}</td>
                        </tr>
                        <tr>
                            <td>Gastos Operacionales de administración</td>
                             <td>{{number_format($s4)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>UTILIDAD OPERACIONAL</strong></td>
                        </tr>
                        <tr>
                            <td>Ingresos no operacionales</td>
                             <td>{{number_format($s5)}}</td>
                        </tr>
                        <tr>
                            <td>Gastos no operacionales</td>
                             <td>{{number_format($s6)}}</td>
                        </tr>
                        <tr>
                            <td>Nomina</td>
                             <td>{{number_format($nomina->nomina)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>UTILIDAD NETA ANTES DE IMPUESTOS</strong></td>
                        </tr>
                        <tr>
                            <td>Impuesto de renta y complementarios</td>
                             <td>{{number_format($s7)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>UTILIDAD LÍQUIDA</strong></td>
                        </tr>
                        <tr>
                            <td>Reservas</td>
                             <td>{{number_format($s8)}}</td>
                        </tr>
                        <tr>
                            <td><strong>UTILIDAD DEL EJERCICIO</strong></td>
                            @if($ss<0)
                            	<td style="background-color:#D36E70"><strong>{{number_format($ss)}}</strong></td>
                            @else
                            	<td style="background-color:#BDECB6"><strong>{{number_format($ss)}}</strong></td>
                            @endif
                        </tr>
                    </tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
@endsection