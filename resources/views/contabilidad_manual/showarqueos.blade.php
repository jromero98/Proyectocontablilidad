@extends('layouts.admin')
@section('contenido')
   <div style="text-align:center">
            <h3> Balance de Arqueos</h3>
    @include('contabilidad_manual.searcharqueo')
</div>
@if(!count($cuentas)==0)
<div style="overflow-x: auto;">
    <table width="50" class="table table-striped table-bordered" id="myTable">
        <thead class="thead-inverse">
            <tr>
                <th data-field="Fecha">Fecha</th>
                <th data-field="Codigo">Codigo</th>
                <th data-field="Nombre">Nombre </th>
                <th data-field="N° Comprobante">N° Comprobante </th>
                <th data-field="Deber">Deber</th>  
                <th data-field="Haber">Haber</th>   
            </tr>
        </thead>
        
        <tbody>
        <?php $totalh = 0.0; $totald = 0.0; ?>
        @foreach ($cuentas as $c)  
            <tr>
               <td >{{Carbon\Carbon::parse($c->fecha)->format('d/m/Y')}}</td>
               <td>{{$c->cod_puc}}</td>
               <td >{{$c->nom_puc}}</td>
               <td >{{$c->comprobante}}</td>
               @if ($c->naturaleza == 0)
                <td>{{number_format($c->valor)}}</td>
                <td></td>
                <?php $totalh += $c->valor; ?>
               @else
                <td></td>
                <td >{{number_format($c->valor)}}</td>
                <?php $totald += $c->valor; ?>
               @endif
             </tr>


        @endforeach
        </tbody>
        
        <thead class="thead-inverse">
            <tr>
                <th data-field=""></th>
                <th data-field=""></th>
                <th data-field=""></th>
                <th data-field="Total">Total </th>
                <th data-field="Deber">{{number_format($totalh)}}</th>  
                <th data-field="Haber">{{number_format($totald)}}</th>   
            </tr>
        </thead>
        
    </table>
</div>
@else
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>¡Upps!</strong> No se encontraron datos asociados a la busqueda en nuestros registros.
</div>
@endif
@endsection