<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EstadosyArqueoController extends Controller
{
    public function index(Request $request)
    {
        return view('estadosyarqueo.estadoderesultados.index');
     }
    public function create(){
         return view('estadosyarqueo.estadoderesultados.create',["vivero" => DB::table('datosvivero')->select('Nom_vivero')->first()]);
    }
    public function show(Request $request)
    {
        return view('estadosyarqueo.estadoderesultados.show',["vivero" => DB::table('datosvivero')->select('Nom_vivero')->first()]);
     }
}
