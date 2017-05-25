<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosVivero extends Model
{
	protected $table='Datosvivero';
    
    protected $primaryKey='Id_vivero';
    
    public $timestamps=false;

    protected $fillable=[
    'Nit_vivero',
    'Nom_vivero',
    'Direccion_vivero',
    'Telefono_vivero'
    ];
    
}
