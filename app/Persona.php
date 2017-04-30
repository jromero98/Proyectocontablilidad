<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='Persona';
    
    protected $primaryKey='doc_persona';
    
    public $timestamps=false;

    protected $fillable=[
    'doc_persona',
    'nombre_persona',
    'direccion',
    'telefono',
    'email',
    'tipo'
    ];
}
