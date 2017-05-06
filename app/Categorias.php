<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table='categorias';
    
    protected $primaryKey='idCategorias';
    
    public $timestamps=false;

    protected $fillable=[
    'idCategorias',
    'Nombre_categoria',
    'Descripcion',
    'Color'
    ];
}
