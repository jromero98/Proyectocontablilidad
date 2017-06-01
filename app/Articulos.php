<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $table='articulos';
    
    protected $primaryKey='idarticulos';
    
    public $timestamps=false;

    protected $fillable=[
    'idarticulos',
    'nom_articulo',
    'categorias_idcategorias',
    'stock',
    'maximo',
    'minimo',
    'estado',
    'precio_venta',
    'imagen'
    ];
}
