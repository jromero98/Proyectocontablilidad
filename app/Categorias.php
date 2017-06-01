<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table='categorias';
    
    protected $primaryKey='idcategorias';
    
    public $timestamps=false;

    protected $fillable=[
    'idcategorias',
    'nombre_categoria',
    'descripcion',
    'color'
    ];
}
