<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descripcion_Cuenta extends Model
{
    protected $table='descripcion_cuenta';
    
    protected $fillable=[
    'id_cuentas',
    'Descripcion',
    ];
}
