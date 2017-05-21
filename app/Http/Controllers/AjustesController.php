<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DatosVivero;
use App\Ajustes;

class AjustesController extends Controller
{
    public function show($id){
        return view("ajustes.edit",["ajuste"=>Ajustes::first(),"vivero"=>DatosVivero::first()]);
    }
    public function update(Request $request,$id){
    	$ajuste=Ajustes::findOrFail($id);
    	$ajuste->UVT=str_replace(",", "",$request->get('uvt'));
        $ajuste->salariominimo=str_replace(",", "",$request->get('salariomin'));
    	$ajuste->auxcomida=str_replace(",", "",$request->get('auxcom'));
        $ajuste->update();
        return Redirect::to('/home');
    }
    public function updatedatos(Request $request,$id){
        $datosvivero=DatosVivero::findOrFail($id);
        $datosvivero->Nit_vivero=$request->get('nit');
        $datosvivero->Nom_vivero=$request->get('nombre');
        $datosvivero->Direccion_vivero=$request->get('direccion');
        $datosvivero->Telefono_vivero=$request->get('telefono');
        $datosvivero->update();
        return Redirect::to('/home');
    }
}
