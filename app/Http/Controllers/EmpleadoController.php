<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\EmpleadoFormRequest;
use App\Cargo;
use App\Empleado;
use DB;

class EmpleadoController extends Controller
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
            return view('nomina.empleados.index',["searchText"=>$query,"empleados"=>$empleados]);
        }
    }
    public function create(){
         return view("nomina.empleados.create",["cargos"=>Cargo::get()]);
    }
    public function store(EmpleadoFormRequest $request){
        $empleado=new Empleado;
        $empleado->idCargo=$request->get('idcargo');
        $empleado->ced_empleado=$request->get('cedula');
        $empleado->nombre_empleado=$request->get('nombre');
        $empleado->apellido_empleado=$request->get('apellido');
        $empleado->dir_empleado=$request->get('direccion');
        $empleado->tel_empleado=$request->get('telefono');
        $empleado->email=$request->get('correo');
        if (Input::hasFile('image')){
            $file=Input::file('image');
            $file->move(public_path().'/Imagenes/Empleados/',$request->get('cedula').$file->getClientOriginalName());
            $empleado->foto_empleado=$request->get('cedula').$file->getClientOriginalName();
        }else{
            $empleado->foto_empleado="blanco.png";
        }
        $empleado->save();

        if ($request->get('vdependientes')=="si") {
            DB::table('deduccionempleado')->insert(
            array('iddeduccionempleado'=>1,'Empleados_ced_empleado' => $request->get('cedula'), 'valordeduccion' => 0)
            );
        }
        if ($request->get('medicinapos')!=0) {
            DB::table('deduccionempleado')->insert(
            array('iddeduccionempleado'=>2,'Empleados_ced_empleado' => $request->get('cedula'), 'valordeduccion' => str_replace(",", "", $request->get('medicinapos')))
            );
        }
        if ($request->get('vfondos')!=0) {
            DB::table('deduccionempleado')->insert(
            array('iddeduccionempleado'=>3,'Empleados_ced_empleado' => $request->get('cedula'), 'valordeduccion' => str_replace(",", "", $request->get('vfondos')))
            );
        }
        if ($request->get('vpresv')!=0) {
            DB::table('deduccionempleado')->insert(
            array('iddeduccionempleado'=>4,'Empleados_ced_empleado' => $request->get('cedula'), 'valordeduccion' => str_replace(",", "", $request->get('vpresv')))
            );
        }
        if ($request->get('vfondoe')!=0) {
            DB::table('deduccionempleado')->insert(
            array('iddeduccionempleado'=>5,'Empleados_ced_empleado' => $request->get('cedula'), 'valordeduccion' => $request->get('vfondoe'))
            );
        }

        return Redirect::to('/empleados');
    }
    public function edit($id){
    	$empleado=Empleado::findOrFail($id);
        $deducciones=DB::table("deduccionempleado")
                     ->where('Empleados_ced_empleado',"=",$id)
                     ->orderBy('iddeduccionempleado')
                     ->get();
    	return view("nomina.empleados.edit",["cargos"=>Cargo::get(),"empleado"=>$empleado,"deducciones"=>$deducciones]);
    }
    public function update(EmpleadoFormRequest $request,$id){
        $empleado=Empleado::findOrFail($id);
        $empleado->idCargo=$request->get('idcargo');
        $empleado->ced_empleado=$request->get('cedula');
        $empleado->nombre_empleado=$request->get('nombre');
        $empleado->apellido_empleado=$request->get('apellido');
        $empleado->dir_empleado=$request->get('direccion');
        $empleado->tel_empleado=$request->get('telefono');
        $empleado->email=$request->get('correo');
        if (Input::hasFile('image')){
            $file=Input::file('image');
            $file->move(public_path().'/Imagenes/Empleados/',$request->get('cedula').$file->getClientOriginalName());
            $empleado->foto_empleado=$request->get('cedula').$file->getClientOriginalName();
        }
        $empleado->update();
        DB::table('deduccionempleado')
            ->where('Empleados_ced_empleado', '=', $request->get('cedula'))
            ->where('iddeduccionempleado', '=', 1)
            ->delete();
        DB::table('deduccionempleado')
            ->where('Empleados_ced_empleado', '=', $request->get('cedula'))
            ->where('iddeduccionempleado', '=', 2)
            ->delete();
        DB::table('deduccionempleado')
            ->where('Empleados_ced_empleado', '=', $request->get('cedula'))
            ->where('iddeduccionempleado', '=', 3)
            ->delete();
        DB::table('deduccionempleado')
            ->where('Empleados_ced_empleado', '=', $request->get('cedula'))
            ->where('iddeduccionempleado', '=', 4)
            ->delete();
        DB::table('deduccionempleado')
            ->where('Empleados_ced_empleado', '=', $request->get('cedula'))
            ->where('iddeduccionempleado', '=', 5)
            ->delete();
        if ($request->get('vdependientes')=="si") {
            DB::table('deduccionempleado')->insert(
            array('iddeduccionempleado'=>1,'Empleados_ced_empleado' => $request->get('cedula'), 'valordeduccion' => 0)
            );
        }
        if (str_replace(",", "", $request->get('medicinapos'))!=0) {
            DB::table('deduccionempleado')->insert(
            array('iddeduccionempleado'=>2,'Empleados_ced_empleado' => $request->get('cedula'), 'valordeduccion' => str_replace(",", "", $request->get('medicinapos')))
            );
        }
        if (str_replace(",", "", $request->get('vfondos'))!=0) {
            DB::table('deduccionempleado')->insert(
            array('iddeduccionempleado'=>3,'Empleados_ced_empleado' => $request->get('cedula'), 'valordeduccion' => str_replace(",", "", $request->get('vfondos')))
            );
        }
        if (str_replace(",", "", $request->get('vpresv'))!=0) {
            DB::table('deduccionempleado')->insert(
            array('iddeduccionempleado'=>4,'Empleados_ced_empleado' => $request->get('cedula'), 'valordeduccion' => str_replace(",", "", $request->get('vpresv')))
            );
        }
        echo $request->get('vfondoe')." este es el valor";
        if ($request->get('vfondoe')!=0) {
            DB::table('deduccionempleado')->insert(
            array('iddeduccionempleado'=>5,'Empleados_ced_empleado' => $request->get('cedula'), 'valordeduccion' => $request->get('vfondoe'))
            );
        }
        return Redirect::to('/empleados');
    }
    public function destroy($id){
        $empleado=Empleado::findOrFail($id);
        $empleado->destoy();
        return Redirect::to('empleados');
    }
}
