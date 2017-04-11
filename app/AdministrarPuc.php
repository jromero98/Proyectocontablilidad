<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministrarPuc extends Model
{
    protected $table='puc';
    
    protected $primaryKey='cod_puc';
    
    public $timestamps=false;

    protected $fillable=[
    'cod_puc',
    'nom_puc',
    'clase_puc'
    ];
}
