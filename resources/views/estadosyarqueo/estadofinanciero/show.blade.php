@extends('layouts.admin')
@section('contenido')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link href="{{asset('css/daterangepicker.css')}}" rel="stylesheet">
<div class="row">
	<div class="col-xs-12 text-center" style="background-color:#CBFF48;" >
        <br> 
         <h3>{{$vivero->nom_vivero}}</h3>
          <h3>Estado de resultados</h3>
          
        <h3 for="">28/5/2017 A 29/5/2017</h3>
            <br>
    </div>
            
       <br> <br>
       
	</div>
	

</div>
<br> <br>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="display table" id="estadoresultado">
				<thead>
					<th></th>
					<th>Saldo inicial</th>
					<th>Debitos</th>
					<th>Creditos</th>
					<th>Nuevo saldo</th>
				</thead>

				<tbody>
				
						<tr>
							<td>Ingresos</td>
							<td>141.959.332,00</td>
							<td>0,00</td>
							<td>476.265,00</td>
							<td>141.483.067,00</td>
						</tr>
				</tbody>
				<tfoot>
						
							<th>Total ingresos operacionales</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th>77777</th>
						
					</tfoot>
			</table>
		</div>
	</div>
		<div class="form-group text-center">
			<a class="btn btn-primary " type="submit" id="generar"  href="#">Guardar</a>
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
         
} );
</script>
@endsection