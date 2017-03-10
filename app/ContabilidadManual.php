<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContabilidadManual extends Model
{
    protected $table='cuentas';

    public $timestamps=false;

    protected $fillable=[
    'cod_puc',
    'valor',
    'fecha',
    'naturaleza'
    ];
    
}
