<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EstadoFinancieroController extends Controller
{
    public function index(Request $request)
    {
        return view('estadosyarqueo.estadofinanciero.index');
     }
    public function create(Request $request)
    {
        return view('estadosyarqueo.estadofinanciero.create',["vivero" => DB::table('datosvivero')->select('Nom_vivero')->first()]);
     }
    public function show(Request $request)
    {
        return view('estadosyarqueo.estadofinanciero.show',["vivero" => DB::table('datosvivero')->select('Nom_vivero')->first()]);
     }
}
