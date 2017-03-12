@extends('layouts.admin')
@section('contenido')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div id="striped" class="section scrollspy">
            <h2 class="header"> Balance</h2>
    </div>
               @include('contabilidad_manual.search')
                <div style="overflow-x: auto;">
                    <table width="50" class="table table-striped" id="myTable">
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
                                <td>{{$c->valor}}</td>
                                <td></td>
                                <?php $totalh += $c->valor; ?>
                               @else
                                <td></td>
                                <td >{{$c->valor}}</td>
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
                                <th data-field="Deber">{{$totalh}}</th>  
                                <th data-field="Haber">{{$totald}}</th>   
                            </tr>
                        </thead>
                    </table>
        </div>
@endsection