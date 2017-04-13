<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Categorias;

class CategoriasController extends Controller
{
    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $categorias=Categorias::orderBy('idCategorias','asc')
            ->paginate(2);
            return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
        }
    }
    public function create(){
         return view("almacen.categoria.create");
    }
    public function edit($id){
        return view("almacen.categoria.edit",["categoria"=>Categorias::findOrFail($id)]);
    }
    public function update(Request $request,$id){
        $categoria=Categorias::findOrFail($id);
        $categoria->Nombre_categoria=$request->get('nombre');
        $categoria->Descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
    public function store(Request $request){
        $categoria=new Categorias;
        $categoria->Nombre_categoria=$request->get('nombre');
        $categoria->Descripcion=$request->get('descripcion');
        $categoria->save();
        return Redirect::to('almacen/categoria');
    }
    public function destroy($id){
        $categoria=Categorias::findOrFail($id);
        $categoria->delete();
        return Redirect::to('almacen/categoria');
    }
}
