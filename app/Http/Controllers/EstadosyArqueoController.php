<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;

class EstadosyArqueoController extends Controller
{
    public function index(Request $request)
    {
        $estados=DB::table('estadosresultados')
            ->select('id', 'fechainicio', 'fechafin')
            ->get();
        return view('estadosyarqueo.estadoderesultados.index',compact("estados"));
     }
    public function create(){
        $vivero= DB::table('datosvivero')->select('Nom_vivero')->first();
        $venta=DB::table('facturas')
            ->join("cuentas","idFacturas","=","idFactura")
            ->select(DB::raw('SUM(valor) as venta'))
            ->where("Tipo_factura","=",'Fv')
            ->where("cod_puc","=",'1305')
            ->orwhere("cod_puc","=",'1105')
            ->where("Tipo_factura","=",'Fv')
            //->whereBetween('fecha', ['2017-05-02', '2017-05-05'])
            ->first();
        $nomina=DB::table('cuentas')
            ->select(DB::raw('SUM(valor) as nomina'))
            ->where("comprobante","=","Nomina")
            ->where("cod_puc","=",'1105')
            //->whereBetween('fecha', ['2017-05-02', '2017-05-05'])
            ->first();

        $s1 = DB::table('cuentas')
                     ->where('cod_puc', '=', 4175)
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $s2 = DB::table('cuentas')
                     ->join('puc', 'puc.cod_puc', '=', 'cuentas.cod_puc')
                     ->where('clase_puc', '=', 6)
                     ->groupBy('puc.cod_puc')
                     ->sum('valor');
        $s3 = DB::table('cuentas')
                     ->where('cod_puc', '=', 470580)
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $s4 = DB::table('cuentas')
                     ->where('cod_puc', '=', 470575)
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $s5 = DB::table('cuentas')
                     ->where('cod_puc', '=', 470570)
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $s6 = DB::table('cuentas')
                     ->where('cod_puc', '=', 470585)
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $s7 = DB::table('cuentas')
                     ->where('cod_puc', 'LIKE', '52%')
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $s8 = DB::table('cuentas')
                     ->where('cod_puc', 'LIKE', '33%')
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $ss = $venta->venta- $s1 - $s2 - $s3 - $s4 + $s5 - $s6 - $s7 - $s8-$nomina->nomina;
        return view('estadosyarqueo.estadoderesultados.create',compact('vivero',"venta","s1","s2","s3","s4","s5","s6","s7","s8","ss","nomina"));
    }
    public function edit($id)
    {
        $vivero= DB::table('datosvivero')->select('Nom_vivero')->first();
        $venta=DB::table('facturas')
            ->join("cuentas","idFacturas","=","idFactura")
            ->select(DB::raw('SUM(valor) as venta'))
            ->where("Tipo_factura","=",'Fv')
            ->where("cod_puc","=",'1305')
            ->orwhere("cod_puc","=",'1105')
            ->where("Tipo_factura","=",'Fv')
            //->whereBetween('fecha', ['2017-05-02', '2017-05-05'])
            ->first();
        $nomina=DB::table('cuentas')
            ->select(DB::raw('SUM(valor) as nomina'))
            ->where("comprobante","=","Nomina")
            ->where("cod_puc","=",'1105')
            //->whereBetween('fecha', ['2017-05-02', '2017-05-05'])
            ->first();

        $s1 = DB::table('cuentas')
                     ->where('cod_puc', '=', 4175)
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $s2 = DB::table('cuentas')
                     ->join('puc', 'puc.cod_puc', '=', 'cuentas.cod_puc')
                     ->where('clase_puc', '=', 6)
                     ->groupBy('puc.cod_puc')
                     ->sum('valor');
        $s3 = DB::table('cuentas')
                     ->where('cod_puc', '=', 470580)
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $s4 = DB::table('cuentas')
                     ->where('cod_puc', '=', 470575)
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $s5 = DB::table('cuentas')
                     ->where('cod_puc', '=', 470570)
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $s6 = DB::table('cuentas')
                     ->where('cod_puc', '=', 470585)
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $s7 = DB::table('cuentas')
                     ->where('cod_puc', 'LIKE', '52%')
                     ->groupBy('cod_puc')
                     ->sum('valor');
        $s8 = DB::table('cuentas')
                     ->where('cod_puc', 'LIKE', '33%')
                     ->groupBy('cod_puc')
                     ->sum('valor'); 
        $estadosresultados = DB::table('estadosresultados')
                    ->select('fechainicio','fechafin')
                     ->where('id', '=',$id)
                     ->first();
        $ss = $venta->venta- $s1 - $s2 - $s3 - $s4 + $s5 - $s6 - $s7 - $s8-$nomina->nomina;
        return view('estadosyarqueo.estadoderesultados.show',compact('vivero',"venta","s1","s2","s3","s4","s5","s6","s7","s8","ss","nomina","estadosresultados"));
    }
    public function store(Request $request)
    {

            $fh1=str_replace("/", "-", $request->get('fechainicio'));
            $fh2=str_replace("/", "-", $request->get('fechafin'));
        DB::table('estadosresultados')->insert(
            array('fechainicio'=>Carbon::parse($fh1)->format('Y-m-d'),'fechafin' => Carbon::parse($fh2)->format('Y-m-d')));
        
        return Redirect::to('/estadoderesultados');
    }
}
