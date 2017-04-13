<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table='Detalle_factura';
    
    public $timestamps=false;
    
    protected $fillable=[
    'idArticulo',
    'idFactura',
    'cantidad',
    'precio_compra',
    'precio_venta',
    'descuento'
    ];
}
