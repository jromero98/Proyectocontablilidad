<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosVivero extends Model
{
	protected $table='datosvivero';
    
    protected $primaryKey='id_vivero';
    
    public $timestamps=false;

    protected $fillable=[
    'nit_vivero',
    'nom_vivero',
    'direccion_vivero',
    'telefono_vivero'
    ];
    
}
