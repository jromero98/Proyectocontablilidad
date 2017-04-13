<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\AdministrarPuc;
use DB;

class AdministrarPucController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            if($request->get('clase')==""){
                $pucs=DB::table('puc')
                ->select('cod_puc','nom_puc','clase_puc')
                ->where('cod_puc','LIKE','%'.$query.'%')
                ->orwhere('nom_puc','LIKE','%'.$query.'%') 
                ->orderBy('cod_puc','asc')
                ->paginate(7);
            }else{
                $pucs=DB::table('puc')
                ->select('cod_puc','nom_puc','clase_puc')
                ->where([['clase_puc','=',$request->get('clase')],['cod_puc','LIKE','%'.$query.'%']])
                ->orwhere([['clase_puc','=',$request->get('clase')],['nom_puc','LIKE','%'.$query.'%']]) 
                ->orderBy('cod_puc','asc')
                ->paginate(7);
            }
            $clase=DB::table('clase_puc')->get();
            return view('administracion_puc.index',["pucs"=>$pucs,"searchText"=>$request,'clases'=>$clase]);
        }
    }
    public function create(){
        $clase=DB::table('clase_puc')->get();
        return view('administracion_puc.create',["clases"=>$clase]);
    }
    public function edit($id){
        $puc=AdministrarPuc::findOrFail($id);
        $clase=DB::table('clase_puc')->get();
        return view('administracion_puc.edit',["puc"=>$puc,"clases"=>$clase]);
    } 
    public function store(Request $request){
        $puc = new AdministrarPuc;
        $puc->cod_puc=$request->get('cuenta');
        $puc->nom_puc=$request->get('descripcion');
        $puc->clase_puc=$request->get('clase');
        $puc->save();
        return Redirect::to('puc');
    }
    public function update(Request $request,$id){
        if($request->get('cuenta')==$request->get('rcuenta')){
            $puc = AdministrarPuc::findOrFail($id);
            $puc->nom_puc=$request->get('descripcion');
            $puc->clase_puc=$request->get('clase');
            $puc->update();
        }else{
            $puc=AdministrarPuc::findOrFail($id);
            $puc->delete();
            $puc = new AdministrarPuc;
            $puc->cod_puc=$request->get('cuenta');
            $puc->nom_puc=$request->get('descripcion');
            $puc->clase_puc=$request->get('clase');
            $puc->save();
        }
        return Redirect::to('puc');
    }
    
    public function destroy($id){
        $puc=AdministrarPuc::findOrFail($id);
        $puc->delete();
        return Redirect::to('puc');
    }
}
