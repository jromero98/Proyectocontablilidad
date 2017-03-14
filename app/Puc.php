<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puc extends Model
{
    protected $table = 'puc';

    protected $fillable = ['cod_puc','nom_puc'];
}
