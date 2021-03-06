<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table='empleados';
    
    protected $primaryKey='ced_empleado';
    
    public $timestamps=false;

    protected $fillable=[
    'ced_empleado',
    'nombre_empleado',
    'apellido_empleado',
    'dir_empleado',
    'tel_empleado',
    'email',
    'idcargo',
    'foto_empleado'
    ];
}
