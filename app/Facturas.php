<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    protected $table='facturas';
    
    protected $primaryKey='idfacturas';
    
    public $timestamps=false;
    
    protected $fillable=[
    'tipo_factura',
    'num_factura',
    'fecha',
    'doc_persona',
    'estado'
    ];
}
