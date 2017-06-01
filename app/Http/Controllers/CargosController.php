<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Cargo;

class CargosController extends Controller
{
    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            if ($query!="") {
                 $cargos=Cargo::where('nombre_cargo','LIKE','%'.$query.'%')
                    ->orwhere('salario_cargo','LIKE','%'.$query.'%')
                    ->paginate(6);
            }else{
                 $cargos=Cargo::paginate(6);
            }
           
            return view('nomina.cargos.index',["searchText"=>$query,"cargos"=>$cargos]);
        }
    }
    public function create(){
         return view("nomina.cargos.create");
    }
    public function edit($id){
        return view("nomina.cargos.edit",["cargo"=>Cargo::findOrFail($id)]);
    }
    public function update(Request $request,$id){
        $cargo=Cargo::findOrFail($id);
        $cargo->nombre_cargo=$request->get('nombre');
        $cargo->salario_cargo=str_replace(",", "",$request->get('salario'));
        $cargo->color_cargo=$request->get('color');
        $cargo->riesgo=$request->get('riesgo');
        $cargo->update();
        return Redirect::to('/cargos');
    }
    public function store(Request $request){
        $cargo=new Cargo;
        $cargo->nombre_cargo=$request->get('nombre');
        $cargo->salario_cargo=str_replace(",", "",$request->get('salario'));
        $cargo->color_cargo=$request->get('color');
        $cargo->riesgo=$request->get('riesgo');
        $cargo->save();
        return Redirect::to('/cargos');
    }
    public function destroy($id){
        $cargo=Cargo::findOrFail($id);
        $cargo->delete();
        return Redirect::to('/cargos');
    }
}
