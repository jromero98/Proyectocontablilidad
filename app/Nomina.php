<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    protected $table='nomina';
    
    protected $primaryKey='idnomina';
    
    public $timestamps=false;
    
    protected $fillable=[
    'empleados_ced_empleado',
    'fecha_nomina',
    'diastrabajados',
    'salario',
    'horased',
    'horasen',
    'bonificaciones',
    'comisiones',
    'auxtransportes',
    'auxalimentos',
    'aporteeps',
    'aportepension',
    'aportefondoempleados',
    'libranza',
    'embargos',
    'retencionfuente'
    ];
}
