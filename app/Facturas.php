<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    protected $table='facturas';
    
    protected $primaryKey='idFacturas';
    
    public $timestamps=false;
    
    protected $fillable=[
    'Tipo_factura',
    'Num_factura',
    'fecha',
    'doc_persona',
    'Estado'
    ];
}
