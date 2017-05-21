<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;
use App\ContabilidadManual;
use App\Descripcion_Cuenta;
use App\Facturas;

class ContabilidadManualController extends Controller
{
    public function __construct(){        
    }
    
    public function index(){
        $cuentas = DB::table('puc')
        ->select('nom_puc', 'cod_puc')
        ->get();
        $auxiliar = DB::table('auxiliar')
        ->select('nom_aux', 'id_aux')
        ->get();
        $tpfactura=DB::table('Facturas')
        ->select(DB::raw('count(Tipo_factura) as cfactura'),'Tipo_factura')
        ->groupBy('Tipo_factura')
        ->get();
        $factura=DB::table('Facturas')
            ->select(DB::raw('count(Tipo_factura) as cfactura'),'Tipo_factura')
            ->where('Tipo_factura','=',1)
            ->groupBy('Tipo_factura')
            ->first();
        return view('contabilidad_manual.create',["cuentas" => $cuentas,"auxiliar"=>$auxiliar,"facturas"=>$tpfactura]);  
    }

    public function store(Request $request, Redirect $redirect)
    {        
        $cuenta = Input::get('cuenta');
        $comprobante = Input::get('nodoc');
        $tfactura=Input::get('tipo_factura');
        $valores = Input::get('valor');
        for($i=0;$i<count($valores);$i++){
            $valores[$i]=str_replace(",", "", $valores[$i]);
        }
        $string = Input::get('fecha');
        $auxiliar = Input::get('auxil');
        $token = strtok($string, " ");
        $cont=0;
        $fh;
        while ($token !== false){
            if ($cont==0) {
                $fh =$token;
            }if ($cont==1) {
                $fecha=$token.":00";
            }
            $cont++;
            $token = strtok(" ");
        } 
        
        $naturalezas = Input::get('naturaleza');
        $desc=Input::get('desc');

        $d = 0.0;
        $h = 0.0;

        for ($i=0; $i < count($cuenta); $i++) { 
            if(strcmp($naturalezas[$i], "debito") ){
                $h += (double)$valores[$i];
            }else{
                $d += (double)$valores[$i];
            }
        }
        if($d != $h ){
            $cuentas = DB::table('puc')
            ->select('nom_puc', 'cod_puc')
            ->get();
            $auxiliares = DB::table('auxiliar')
            ->select('nom_aux', 'id_aux')
            ->get();
            $tpfactura=DB::table('Facturas')
            ->select(DB::raw('count(Tipo_factura) as cfactura'),'Tipo_factura')
            ->groupBy('Tipo_factura')
            ->get();
            for($i=0;$i<count($valores);$i++){
            $valores[$i]=number_format($valores[$i]);
            }
            echo $tfactura;
            $err = "Las cuentas T no están correctamente balanceadas. Hay un desbalance de: $" . number_format(abs($d-$h));
            return view('contabilidad_manual.create')
            ->with("cuent",$cuenta)->with("naturalezas",$naturalezas)->with("cuentas",$cuentas)->with("valores",$valores)
            ->with("auxiliar",$auxiliares)->with("auxiliarr",$auxiliar)->with("comprobante",$comprobante)->with("descripcion",$desc)
            ->with("fecha",$string)->with("facturas",$tpfactura)->with("tpfactura",$tfactura)
            ->withErrors($err)
            ;
        }if($tfactura==""){
            $cuentas = DB::table('puc')
            ->select('nom_puc', 'cod_puc')
            ->get();
            $auxiliares = DB::table('auxiliar')
            ->select('nom_aux', 'id_aux')
            ->get();
            $tpfactura=DB::table('Facturas')
            ->select(DB::raw('count(Tipo_factura) as cfactura'),'Tipo_factura')
            ->groupBy('Tipo_factura')
            ->get();
            for($i=0;$i<count($valores);$i++){
            $valores[$i]=number_format($valores[$i]);
            }
            $err = "Debe de seleccionar un Tipo de comprobante";
            return view('contabilidad_manual.create')
            ->with("cuent",$cuenta)->with("naturalezas",$naturalezas)->with("cuentas",$cuentas)->with("valores",$valores)
            ->with("auxiliar",$auxiliares)->with("auxiliarr",$auxiliar)->with("comprobante",$comprobante)->with("descripcion",$desc)
            ->with("fecha",$string)->with("facturas",$tpfactura)->with("tpfactura",$tfactura)
            ->withErrors($err)
            ;
        }
        if(count($cuenta)>0){
            $descripcion =new Descripcion_Cuenta;
            $descripcion->Descripcion_cuenta=$request->get('desc');
            $descripcion->save();
        }
        for ($i=0; $i < count($cuenta); $i++) {
            $descripcion =Descripcion_Cuenta::where('Descripcion_cuenta','=',$request->get('desc'))->first();
            $cuentas = new ContabilidadManual;
            $cuentas->cod_puc = $cuenta[$i];
            $cuentas->comprobante = $tfactura.$comprobante;
            $cuentas->valor = $valores[$i];
            $cuentas->id_aux = $auxiliar[$i];
            $cuentas->fecha = Carbon::parse($fh)->format('Y-m-d')." ".$fecha;
            $cuentas->cod_Descripcion = $descripcion->idDescripcion_cuenta;
            if(strcmp($naturalezas[$i], "debito") ){
                $cuentas->naturaleza = 0;
            }else{
                $cuentas->naturaleza = 1;
            }
            $cuentas->save();
            if($i+1==count($cuenta)){
                $factura=new Facturas;
                $factura->Tipo_factura=$tfactura;
                $factura->Num_factura=$comprobante;
                $factura->Estado="Manual";
                $factura->save();
            }
        }
        return redirect()->action('BalanceController@index');
    }
    public function getFactura(Request $request,$id){
        if($request->ajax()){
            $tpfactura=DB::table('Facturas')
            ->select(DB::raw('count(Tipo_factura) as cfactura'),'Tipo_factura')
            ->where('Tipo_factura','=',$id)
            ->groupBy('Tipo_factura')
            ->get();
            return response()->json($tpfactura);
        }
    }
}