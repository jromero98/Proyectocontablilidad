<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descripcion_Cuenta extends Model
{
    protected $table='descripcion_cuenta';
    
    protected $primaryKey='idDescripcion_cuenta';
    
    public $timestamps=false;
    
    protected $fillable=[
    'idDescripcion_cuenta',
    'Descripcion_cuenta',
    ];
}
