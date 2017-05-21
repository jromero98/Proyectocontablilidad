<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table='Cargos';
    
    protected $primaryKey='idCargos';
    
    public $timestamps=false;

    protected $fillable=[
    'idCargos',
    'nombre_cargo',
    'salario_cargo',
    'color_cargo',
    'riesgo'
    ];
}
