<html>
    <head>
        <style>
            .header{background:#eee;color:#444;border-bottom:1px solid #ddd;padding:10px;}
            .client-detail{background:#ddd;padding:10px;}
            .client-detail th{text-align:left;}
            .items{border-spacing:0;}
            .items thead{background:#ddd;}
            .items tbody{background:#eee;}
            .items tfoot{background:#ddd;}
            .items th{padding:10px;}
            .items td{padding:10px;}
            h1 small{display:block;font-size:16px;color:#888;}
            table{width:100%;}
            .text-right{text-align:right;}
        </style>
        <title> Factura de Venta # {{$factura->Num_factura}}</title>
    </head>
    <body>

    <div class="header">
       <?php 
                        $persona=DB::table('persona')
                            ->select('doc_persona','nombre_persona','direccion','telefono', 'email')
                            ->where('doc_persona',"=",$factura->doc_persona)
                            ->first();
                    ?>
    
        <h1>
            Factura de Venta # {{$factura->Num_factura}}
            <small>
                Fecha {{Carbon\Carbon::parse($factura->fecha)->format('d/m/Y')}}
            </small>
            <small>
                Nit {{$vivero->Nit_vivero}}
            </small>
            <small>
                 {{$vivero->Nom_vivero}}
            </small>
            <small>
                 Direccion: {{$vivero->Direccion_vivero}}
            </small>
            <small>
                 telefono: {{$vivero->Telefono_vivero}}
            </small>
        </h1>
    </div>
    <table class="client-detail">
        @if(count($persona)==0)
            <tr>
            <th style="width:100px;">
                Cliente:  
            </th>
            <td></td>
        </tr>
        <tr>
            <th>CC. Nit:  
            </th>
            <td></td>
        </tr>
        <tr>
            <th>Dirección 
            </th>
            <td></td>
        </tr>
        @else
            <tr>
            <th style="width:100px;">
                Cliente:  {{$persona->nombre_persona}}
            </th>
            <td></td>
        </tr>
        <tr>
            <th>CC. Nit:  {{$persona->doc_persona}}
            </th>
            <td></td>
        </tr>
        <tr>
            <th>Dirección {{$persona->direccion}}
            </th>
            <td></td>
        </tr>
        @endif
    </table>

    <hr />

    <table class="items">
        <thead>
            <tr>
                <th class="text-left">Producto</th>
                <th class="text-right" style="width:100px;">Cantidad</th>
                <th class="text-right" style="width:100px;">Precio.U</th>
                <th class="text-right" style="width:100px;">Iva</th>
                <th class="text-right" style="width:100px;">Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach($detalles as $detalle)
            <tr>
                <td>@foreach($articulos as $art)
                        @if($art->idArticulos==$detalle->idArticulo)
                         {{$art->nom_articulo}}
                       @endif
                    @endforeach
				</td>
                <td class="text-right">{{$detalle->cantidad}}</td>
                <td class="text-right">$ {{number_format($detalle->precio_venta)}}</td>
                <td class="text-right">$ {{number_format($detalle->precio_venta*0.19)}}</td>
                <td class="text-right">$ {{number_format($detalle->cantidad*$detalle->precio_venta)}}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <th></th>
        <tr>
            <td colspan="3" class="text-right"><b>IVA</b></td>
            <td class="text-right">$ {{number_format($valor*0.19)}}</td>
        </tr>
        <th></th>
        <tr>
            <td colspan="3" class="text-right"><b>Sub Total</b></td>
            <td class="text-right">$ {{number_format($valor-$valor*0.19)}}</td>
        </tr>
        <th></th>
        <tr>
            <td colspan="3" class="text-right"><b>Total</b></td>
            <td class="text-right">$ {{number_format($valor)}}</td>
        </tr>
        </tfoot>
    </table>
    </body>
</html>