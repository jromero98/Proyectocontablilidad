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
    </head>
    <body>

    <div class="header">
        <h1>
            Factura de Venta # {{$factura->Num_factura}}
            <small>
                Fecha {{Carbon\Carbon::parse($factura->fecha)->format('d/m/Y')}}
            </small>
        </h1>
    </div>
    <table class="client-detail">
        <tr>
            <th style="width:100px;">
                Cliente
            </th>
            <td></td>
        </tr>
        <tr>
            <th>CC. Nit</th>
            <td></td>
        </tr>
        <tr>
            <th>Dirección</th>
            <td></td>
        </tr>
    </table>

    <hr />

    <table class="items">
        <thead>
            <tr>
                <th class="text-left">Producto</th>
                <th class="text-right" style="width:100px;">Cantidad</th>
                <th class="text-right" style="width:100px;">P.U</th>
                <th class="text-right" style="width:100px;">Dto</th>
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
                <td class="text-right">$ {{number_format($detalle->descuento)}}</td>
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