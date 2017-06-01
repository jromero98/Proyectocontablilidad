<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\ContabilidadManual;
use App\Empleado;
use App\Nomina;
use DateTime;
use DB;

class NominaController extends Controller
{
    public function index(Request $request){
         if($request){
            $query=trim($request->get('searchText'));
            $pagado=0;
            if($query!=""){
                try {
                    $token = strtok($query, " ");
                    $cont=0;
                    $fh;
                    while ($token !== false){
                        if ($cont==0) {
                            $fh =$token;
                        }if ($cont==1) {
                            $fecha=$token;
                        }
                        $cont++;
                        $token = strtok(" ");
                    } 
                    $fh=str_replace("/", "-", $fh);

                    $query=Carbon::parse($fh)->format('Y-m-d')." ".Carbon::parse($fecha)->format('H:m');
                } catch (\Exception $e) {
                    
                }
                $empleados=DB::table('empleados')
                    ->join('cargos','idcargos','=','idcargos')
                    ->join('nomina','empleados_ced_empleado','=','ced_empleado')
                    ->select('ced_empleado','nombre_empleado','apellido_empleado',DB::raw('(diastrabajados*(salario/30)+auxtransportes+auxalimentos+salario*1.25*horased/240+salario*1.55*horasen/240+bonificaciones+comisiones) as Devengado'),'riesgo','dir_empleado','tel_empleado','email','nombre_cargo',
                    'salario_cargo','color_cargo','foto_empleado','fecha_nomina', 'empleados_ced_empleado', 'diastrabajados', 'salario', 'horased', 'horasen', 'bonificaciones','comisiones', 'auxtransportes', 'auxalimentos', 'aporteeps', 'aportepension', 'aportefondoempleados', 'libranza', 'embargos', 'retencionfuente')
                    ->where('fecha_nomina','=',Carbon::parse($fh)->format('Y-m')."-01")
                    ->orderBy('ced_empleado')
                    ->get();
                $pagado=count(ContabilidadManual::where('comprobante',"=","Nomina")->where("fecha","=",Carbon::parse($fh)->format('Y-m')."-01")->get());
                $totales=DB::select('CALL totales(?)',array(Carbon::parse($fh)->format('Y-m')."-01"));
            }else{
                $empleados=DB::table('empleados')
                ->join('cargos','idcargos','=','cargos_idcargos')
                ->join('nomina','empleados_ced_empleado','=','ced_empleado')
                ->select('ced_empleado','nombre_empleado','apellido_empleado',DB::raw('(diastrabajados*(salario/30)+auxtransportes+auxalimentos+salario*1.25*horased/240+salario*1.55*horasen/240+bonificaciones+comisiones) as Devengado'),'dir_empleado','tel_empleado','email','nombre_cargo',
                'salario_cargo','color_cargo','foto_empleado','fecha_nomina','riesgo', 'empleados_ced_empleado', 'diastrabajados', 'salario', 'horased', 'horasen', 'bonificaciones','comisiones', 'auxtransportes', 'auxalimentos', 'aporteeps', 'aportepension', 'aportefondoempleados', 'libranza', 'embargos', 'retencionfuente')
                ->where('fecha_nomina','=',Carbon::parse(Carbon::now('America/Bogota'))->format('Y-m')."-01")
                ->orderBy('ced_empleado')
                ->get();
            $pagado=count(ContabilidadManual::where('comprobante',"=","Nomina")->where("fecha","=",Carbon::parse(Carbon::now('America/Bogota'))->format('Y-m')."-01")->get());
            $totales=DB::select('CALL totales(?)',array(Carbon::parse(Carbon::now('America/Bogota'))->format('Y-m')."-01"));
            }
            return view('nomina.nomina.index',["searchText"=>$query,"empleados"=>$empleados,"totales"=>$totales,"pagado"=>$pagado]);
        }
    }
    public function create(){
        $datoscalculo=DB::table("configsistema")->select('UVT', 'salariominimo', 'auxcomida')->first();
		return view('nomina.nomina.create',["empleados"=>Empleado::get(),"calculo"=>$datoscalculo]);
	}

    public function store(Request $request){
        try {
            $nomina=new Nomina;
            $nomina->empleados_ced_empleado=str_replace(",", "", $request->get('idempleado'));
            $nomina->fecha_nomina=Carbon::parse(Carbon::now('America/Bogota'))->format('Y-m')."-01";
            $nomina->diastrabajados=str_replace(",", "", $request->get('diast'));
            $nomina->salario=str_replace(",", "", $request->get('sueldo'));
            $nomina->horased=str_replace(",", "", $request->get('horased'));
            $nomina->horasen=str_replace(",", "", $request->get('hen'));
            $nomina->auxtransportes=str_replace(",", "", $request->get('auxtrans'));
            $nomina->auxalimentos=str_replace(",", "", $request->get('auxcom'));
            $nomina->bonificaciones=str_replace(",", "", $request->get('bonificacion'));
            $nomina->comisiones=str_replace(",", "", $request->get('comision'));
            $nomina->aporteeps=str_replace(",", "", $request->get('aeps'));
            $nomina->aportepension=str_replace(",", "", $request->get('afp'));
            $nomina->aportefondoempleados=str_replace(",", "", $request->get('afe'));
            $nomina->libranza=str_replace(",", "", $request->get('libranza'));
            $nomina->embargos=str_replace(",", "", $request->get('embargos'));
            $nomina->retencionfuente=str_replace(",", "", $request->get('retencionfuente'));
            $nomina->save();
        } catch (Exception $e) {
                Redirect::to('/nomina')->withErrors("Error al ingresar la Cuenta, revise los datos de la cuenta");
                return redirect('/nomina')
                ->withErrors(['msg', "Ya se ha generado la nomina de este empleado"]);//echo("alert('Ya se ha generado la nomina de este empleado')");
        }catch (\PDOException $e) {
            return response(redirect('/nomina')->withErrors("Ya se ha generado la nomina de este empleado")->withInput());
        }
        return response(Redirect::to('/nomina')->withSuccess("Se ha generado correctamente la nomina")->withInput());
    }
    public function update(Request $request,$id){
        try {
            $nomina=Nomina::findOrFail($id);
            $nomina->diastrabajados=str_replace(",", "", $request->get('diast'));
            $nomina->salario=str_replace(",", "", $request->get('sueldo'));
            $nomina->horased=str_replace(",", "", $request->get('horased'));
            $nomina->horasen=str_replace(",", "", $request->get('hen'));
            $nomina->auxtransportes=str_replace(",", "", $request->get('auxtrans'));
            $nomina->auxalimentos=str_replace(",", "", $request->get('auxcom'));
            $nomina->bonificaciones=str_replace(",", "", $request->get('bonificacion'));
            $nomina->comisiones=str_replace(",", "", $request->get('comision'));
            $nomina->aporteeps=str_replace(",", "", $request->get('aeps'));
            $nomina->aportepension=str_replace(",", "", $request->get('afp'));
            $nomina->aportefondoempleados=str_replace(",", "", $request->get('afe'));
            $nomina->libranza=str_replace(",", "", $request->get('libranza'));
            $nomina->embargos=str_replace(",", "", $request->get('embargos'));
            $nomina->retencionfuente=str_replace(",", "", $request->get('retencionfuente'));
            $nomina->update();
        } catch (Exception $e) {
                Redirect::to('/nomina')->withErrors("Error al ingresar la Cuenta, revise los datos de la cuenta");
                return redirect('/nomina')
                ->withErrors(['msg', "Ya se ha generado la nomina de este empleado"]);//echo("alert('Ya se ha generado la nomina de este empleado')");
        }catch (\PDOException $e) {
            return response(redirect('/nomina')->withErrors("Ocurrio un problema al actualizar la nomina")->withInput());
        }
        return response(Redirect::to('/nomina')->withSuccess("Se ha actualizado correctamente la nomina")->withInput());
    }
    public function edit($id){
        $datoscalculo=DB::table("configsistema")->select('UVT', 'salariominimo', 'auxcomida')->first();
        $empleado=DB::table('empleados')
            ->join('cargos','idcargos','=','cargos_idcargos')
            ->join('nomina','empleados_ced_empleado','=','ced_empleado')
            ->select('idNomina','ced_empleado','nombre_empleado','apellido_empleado','nombre_cargo',
            'salario_cargo','color_cargo','foto_empleado','fecha_nomina', 'empleados_ced_empleado', 'diastrabajados', 'salario', 'horased', 'horasen', 'bonificaciones','comisiones', 'auxtransportes', 'auxalimentos', 'aporteeps', 'aportepension', 'aportefondoempleados', 'libranza', 'embargos', 'retencionfuente')
            ->where('ced_empleado','=',$id)
            ->first();
        return view("nomina.nomina.edit",["empleado"=>$empleado,"calculo"=>$datoscalculo]);
    }
	public function getNomina(Request $request,$id){
        if($request->ajax()){
        	$empleado=DB::table('empleados')->join('cargos','idcargos','=','cargos_idcargos')
            ->select('ced_empleado','salario_cargo')
            ->where('ced_empleado','=',$id)
            ->first();
            return response()->json($empleado);
        }
	} 
    public function getDeducibles(Request $request,$id){
        if($request->ajax()){
            $deducibles=DB::table('deduccionempleado')
            ->select('iddeduccionempleado','empleados_ced_empleado', 'valordeduccion')
            ->where('empleados_ced_empleado','=',$id)
            ->get();
            return response()->json($deducibles);
        }
    }
    public function cerrar(){
        $fecha=Carbon::parse(Carbon::now('America/Bogota'))->format('Y-m')."-01";
        $pagado=count(ContabilidadManual::where('comprobante',"=","Nomina")->where("fecha","=",$fecha)->get());
        $cuentastotales=DB::select('CALL cuentastotal(?)',array($fecha));
        if ($pagado==0) {
            $aporteeps=0;   $aportePension=0; $ARL=0; $SENA=0; $ICBF=0; $Cajacompensacion=0; $Cesantias=0; $Interesescesantias=0;$Prima=0; $Vacaciones=0;;
            $empleado=DB::table('empleados')
                ->join('cargos','idcargo','=','idcargos')
                ->join('nomina','empleados_ced_empleado','=','ced_empleado')
                ->select(DB::raw('sum(diastrabajados*(salario/30)+auxtransportes+auxalimentos+salario*1.25*horased/240+salario*1.55*horasen/240+bonificaciones+comisiones) as Devengado'),DB::raw('sum(riesgo) as riesgo'),DB::raw('sum(auxtransportes) as auxtransportes'))
                ->where('fecha_nomina','=',$fecha)
                ->first();
            $aporteeps+=($empleado->Devengado-$empleado->auxtransportes)*0.085;
            $aportePension+=($empleado->Devengado-$empleado->auxtransportes)*0.12;
            $ARL+=($empleado->Devengado-$empleado->auxtransportes)*($empleado->riesgo/100);
            $SENA+=($empleado->Devengado-$empleado->auxtransportes)*0.02;
            $ICBF+=($empleado->Devengado-$empleado->auxtransportes)*0.03; 
            $Cajacompensacion+=($empleado->Devengado-$empleado->auxtransportes)*0.04;
            $Cesantias+=($empleado->Devengado)*0.0833;
            $Interesescesantias+=(($empleado->Devengado)*0.0833)*0.01;
            $Prima+=($empleado->Devengado)*0.0833; 
            $Vacaciones+=($empleado->Devengado)*0.0417;

            if ($aporteeps!=0&&$aporteeps!="") {
                NominaController::subircuentas(510569,'Aporte',$aporteeps,$fecha,0);
                NominaController::subircuentas(237005,'Aporte',$aporteeps,$fecha,1);
            }
            if ($aportePension!=0&&$aportePension!="") {
                NominaController::subircuentas(510570,'Aporte',$aportePension,$fecha,0);
                NominaController::subircuentas(238030,'Aporte',$aportePension,$fecha,1);
            }
            if ($ARL!=0&&$ARL!="") {
                NominaController::subircuentas(510568,'Aporte',$ARL,$fecha,0);
                NominaController::subircuentas(237006,'Aporte',$ARL,$fecha,1);
            }
            if ($SENA!=0&&$SENA!="") {
                NominaController::subircuentas(510578,'Aporte',$SENA,$fecha,0);
                NominaController::subircuentas(237010,'Aporte',$SENA,$fecha,1);
            }
            if ($ICBF!=0&&$ICBF!="") {
                NominaController::subircuentas(510575,'Aporte',$ICBF,$fecha,0);
                NominaController::subircuentas(237010,'Aporte',$ICBF,$fecha,1);
            }
            if ($Cajacompensacion!=0&&$Cajacompensacion!="") {
                NominaController::subircuentas(510572,'Aporte',$Cajacompensacion,$fecha,0);
                NominaController::subircuentas(237010,'Aporte',$Cajacompensacion,$fecha,1);
            }
            if ($Cesantias!=0&&$Cesantias!="") {
                NominaController::subircuentas(510530,'Aporte',$Cesantias,$fecha,0);
                NominaController::subircuentas(261005,'Aporte',$Cesantias,$fecha,1);
            }
            if ($Interesescesantias!=0&&$Interesescesantias!="") {
                NominaController::subircuentas(520533,'Aporte',$Interesescesantias,$fecha,0);
                NominaController::subircuentas(261010,'Aporte',$Interesescesantias,$fecha,1);
            }
            if ($Prima!=0&&$Prima!="") {
                NominaController::subircuentas(510536,'Aporte',$Prima,$fecha,0);
                NominaController::subircuentas(261020,'Aporte',$Prima,$fecha,1);
            }
            if ($Vacaciones!=0&&$Vacaciones!="") {
                NominaController::subircuentas(510539,'Aporte',$Vacaciones,$fecha,0);
                NominaController::subircuentas(261015,'Aporte',$Vacaciones,$fecha,1);
            }
            foreach ($cuentastotales as $cuentastotal) {
                if ($cuentastotal->Sueldos!=0&&$cuentastotal->Sueldos!="") {
                    NominaController::subircuentas(510506,'Nomina',$cuentastotal->Sueldos,$fecha,0);
                }
                if ($cuentastotal->Horasextras!=0&&$cuentastotal->Horasextras!="") {
                    NominaController::subircuentas(510515,'Nomina',$cuentastotal->Horasextras,$fecha,0);
                }
                if ($cuentastotal->axtrans!=0&&$cuentastotal->axtrans!="") {
                    NominaController::subircuentas(510527,'Nomina',$cuentastotal->axtrans,$fecha,0);
                }
                if ($cuentastotal->axali!=0&&$cuentastotal->axali!="") {
                    NominaController::subircuentas(510545,'Nomina',$cuentastotal->axali,$fecha,0);
                }
                if ($cuentastotal->bonificaciones!=0&&$cuentastotal->bonificaciones!="") {
                    NominaController::subircuentas(510548,'Nomina',$cuentastotal->bonificaciones,$fecha,0);
                }
                if ($cuentastotal->comisiones!=0&&$cuentastotal->comisiones!="") {
                    NominaController::subircuentas(510518,'Nomina',$cuentastotal->comisiones,$fecha,0);
                }
                if ($cuentastotal->aporteseps!=0&&$cuentastotal->aporteseps!="") {
                    NominaController::subircuentas(237005,'Nomina',$cuentastotal->aporteseps,$fecha,1);
                }
                if ($cuentastotal->aportespensiones!=0&&$cuentastotal->aportespensiones!="") {
                    NominaController::subircuentas(238030,'Nomina',$cuentastotal->aportespensiones,$fecha,1);
                }
                if ($cuentastotal->fondoempleados!=0&&$cuentastotal->fondoempleados!="") {
                    NominaController::subircuentas(237045,'Nomina',$cuentastotal->fondoempleados,$fecha,1);
                }
                if ($cuentastotal->libranza!=0&&$cuentastotal->libranza!="") {
                    NominaController::subircuentas(237030,'Nomina',$cuentastotal->libranza,$fecha,1);
                }
                if ($cuentastotal->embargos!=0&&$cuentastotal->embargos!="") {
                    NominaController::subircuentas(237025,'Nomina',$cuentastotal->embargos,$fecha,1);
                }
                if ($cuentastotal->retencion!=0&&$cuentastotal->retencion!="") {
                    NominaController::subircuentas(2365,'Nomina',$cuentastotal->retencion,$fecha,1);
                }
                if ($cuentastotal->Total!=0&&$cuentastotal->Total!="") {
                    NominaController::subircuentas(1105,'Nomina',$cuentastotal->Total,$fecha,1);
                }
            }
        }
        return Redirect::to('/nomina');
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
