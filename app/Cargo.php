<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table='cargos';
    
    protected $primaryKey='idcargos';
    
    public $timestamps=false;

    protected $fillable=[
    'idcargos',
    'nombre_cargo',
    'salario_cargo',
    'color_cargo',
    'riesgo'
    ];
}
