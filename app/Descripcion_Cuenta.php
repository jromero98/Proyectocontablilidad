<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descripcion_Cuenta extends Model
{
    protected $table='descripcion_cuenta';
    
    protected $primaryKey='iddescripcion_cuenta';
    
    public $timestamps=false;
    
    protected $fillable=[
    'iddescripcion_cuenta',
    'descripcion_cuenta',
    ];
}
