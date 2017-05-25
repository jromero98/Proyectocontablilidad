<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContabilidadManual;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;

class ArqueoController extends Controller
{
    public function index(){
        $estadosd=DB::table('cuentas')
            ->join('puc','cuentas.cod_puc',"=",'puc.cod_puc')
            ->select(DB::raw('puc.cod_puc as cod_puc'),'nom_puc',DB::raw('sum(valor) as valor'),'clase_puc',DB::raw('cuentas.naturaleza as naturaleza_cuenta'))
            ->where(DB::raw('cuentas.naturaleza'),'=',0)
            ->where(DB::raw('puc.cod_puc'),'=',1105)
            ->where('comprobante','like','Fv%')
            ->groupBy(DB::raw('puc.cod_puc'),'nom_puc','clase_puc',DB::raw('cuentas.naturaleza'))
            ->get();
        $estadosc=DB::table('cuentas')
            ->join('puc','cuentas.cod_puc',"=",'puc.cod_puc')
            ->select(DB::raw('puc.cod_puc as cod_puc'),'nom_puc',DB::raw('sum(valor) as valor'),'clase_puc',DB::raw('cuentas.naturaleza as naturaleza_cuenta'))
            ->where(DB::raw('cuentas.naturaleza'),'=',1)
            ->where(DB::raw('puc.cod_puc'),'=',1105)
            ->where('comprobante','like','Fv%')
            ->groupBy(DB::raw('puc.cod_puc'),DB::raw('cuentas.naturaleza'),'nom_puc','clase_puc')
            ->get();
        return view('estadosyarqueo.arqueo.index',compact("estadosd","estadosc"));
    }
    public function store(Request $request){
    	$fecha=Carbon::parse(Carbon::now('America/Bogota'))->format('Y-m-d');
    	$efectivo=str_replace(",", "", $request->get('efectivo'));;
    	$efectivop=str_replace(",", "", $request->get('efectivop'));;

    	if($efectivo>$efectivop){
    		ArqueoController::subircuentas(1105,'Arqueo',$efectivo-$efectivop,$fecha,0);
    		ArqueoController::subircuentas(4295,'Arqueo',$efectivo-$efectivop,$fecha,1);
    	}
    	if($efectivo<$efectivop){
    		ArqueoController::subircuentas(1105,'Arqueo',$efectivop-$efectivo,$fecha,1);
    		ArqueoController::subircuentas(5395,'Arqueo',$efectivop-$efectivo,$fecha,0);
    	}
    	return Redirect::to('/home');
    }
    public function subircuentas($puc,$comprobante,$valor,$fecha,$naturaleza){
        $cuentas = new ContabilidadManual;
        $cuentas->cod_puc = $puc;
        $cuentas->comprobante = $comprobante;
        $cuentas->valor = $valor;
        $cuentas->fecha = $fecha;
        $cuentas->naturaleza = $naturaleza;
        $cuentas->cod_Descripcion = 0;
        $cuentas->save();
    }   
}
