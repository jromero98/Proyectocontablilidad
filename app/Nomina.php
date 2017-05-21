<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    protected $table='Nomina';
    
    protected $primaryKey='idNomina';
    
    public $timestamps=false;
    
    protected $fillable=[
    'Empleados_ced_empleado',
    'Fecha_nomina',
    'Diastrabajados',
    'Salario',
    'HorasED',
    'HorasEN',
    'Bonificaciones',
    'Comisiones',
    'Auxtransportes',
    'Auxalimentos',
    'AporteEps',
    'Aportepension',
    'Aportefondoempleados',
    'libranza',
    'embargos',
    'retencionfuente'
    ];
}
