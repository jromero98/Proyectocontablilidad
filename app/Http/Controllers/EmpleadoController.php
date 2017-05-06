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
        return Redirect::to('/empleados');
    }
    public function edit($id){
    	$empleado=Empleado::findOrFail($id);
    	return view("nomina.empleados.edit",["cargos"=>Cargo::get(),"empleado"=>$empleado]);
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
        return Redirect::to('/empleados');
    }
    public function destroy($id){
        $empleado=Empleado::findOrFail($id);
        $empleado->destoy();
        return Redirect::to('empleados');
    }
}
