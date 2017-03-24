<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContabilidadManual extends Model
{
    protected $table='cuentas';

    public $timestamps=false;

    protected $fillable=[
    'cod_puc',
    'comprobante',
    'valor',
    'fecha',
    'naturaleza',
    'id_aux'
    ];
    public function cuenta()
    {
        return $this->belongsTo('\App\Puc', 'cod_puc', 'cod_puc');
    }
}
