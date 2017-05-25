<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $table='articulos';
    
    protected $primaryKey='idArticulos';
    
    public $timestamps=false;

    protected $fillable=[
    'idArticulos',
    'nom_articulo',
    'Categorias_idCategorias',
    'stock',
    'maximo',
    'minimo',
    'Estado',
    'Precio_venta',
    'Imagen'
    ];
}
