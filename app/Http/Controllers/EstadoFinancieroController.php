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
        $estadosd=DB::table('cuentas')
            ->join('puc','cuentas.cod_puc',"=",'puc.cod_puc')
            ->select(DB::raw('puc.cod_puc as cod_puc'),'nom_puc',DB::raw('sum(valor) as valor'),'clase_puc',DB::raw('puc.naturaleza as naturaleza_puc'),DB::raw('cuentas.naturaleza as naturaleza_cuenta'))
            ->where(DB::raw('cuentas.naturaleza'),'=',0)
            ->groupBy(DB::raw('puc.cod_puc'),DB::raw('cuentas.naturaleza'),'nom_puc','clase_puc',DB::raw('puc.naturaleza'))
            ->get();
        $estadosc=DB::table('cuentas')
            ->join('puc','cuentas.cod_puc',"=",'puc.cod_puc')
            ->select(DB::raw('puc.cod_puc as cod_puc'),'nom_puc',DB::raw('sum(valor) as valor'),'clase_puc',DB::raw('puc.naturaleza as naturaleza_puc'),DB::raw('cuentas.naturaleza as naturaleza_cuenta'))
            ->where(DB::raw('cuentas.naturaleza'),'=',1)
            ->groupBy(DB::raw('puc.cod_puc'),DB::raw('cuentas.naturaleza'),'nom_puc','clase_puc',DB::raw('puc.naturaleza'))
            ->get();
        foreach ($estadosd as $estadod) {
            foreach ($estadosc as $estadoc){
                if($estadod->cod_puc==$estadoc->cod_puc){
                    $estadod->valor=$estadod->valor-$estadoc->valor;
                    $estadoc->valor=0;
                }
            }
        }
        $vivero=DB::table('datosvivero')->select('Nom_vivero')->first();
        return view('estadosyarqueo.estadofinanciero.create',["vivero" => $vivero,"estadosd"=>$estadosd,"estadosc"=>$estadosc]);
     }
    public function show(Request $request)
    {
        return view('estadosyarqueo.estadofinanciero.show',["vivero" => DB::table('datosvivero')->select('Nom_vivero')->first()]);
     }
}
