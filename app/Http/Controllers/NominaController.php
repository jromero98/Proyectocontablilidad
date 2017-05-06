<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use DB;

class NominaController extends Controller
{
    public function index(Request $request){
         if($request){
            $query=trim($request->get('searchText'));
            $empleados=DB::table('empleados')->join('cargos','idCargo','=','idCargos')
            ->select('ced_empleado','nombre_empleado','apellido_empleado','dir_empleado','tel_empleado','email','nombre_cargo',
    		'salario_cargo','color_cargo','foto_empleado')
            ->where('Nombre_cargo','LIKE','%'.$query.'%')
            ->where('salario_cargo','LIKE','%'.$query.'%')
            ->paginate(6);
            return view('nomina.nomina.index',["searchText"=>$query,"empleados"=>$empleados]);
        }
    }
    public function create(){
		return view('nomina.nomina.create',["empleados"=>Empleado::get()]);
	}
	public function getNomina(Request $request,$id){
        if($request->ajax()){
        	$empleado=DB::table('empleados')->join('cargos','idCargo','=','idCargos')
            ->select('ced_empleado','salario_cargo')
            ->where('ced_empleado','=',$id)
            ->first();
            return response()->json($empleado);
        }
	}      
}
