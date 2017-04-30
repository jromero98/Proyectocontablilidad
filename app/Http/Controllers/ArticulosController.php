<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Articulos;
use App\Categorias;
use DB;

class ArticulosController extends Controller
{
    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $articulos=DB::table('Articulos')->join('Categorias','Categorias_idCategorias','=','idCategorias')
            ->select('nom_articulo','idArticulos','stock','Nombre_categoria','minimo','maximo','Estado')
            ->where('nom_articulo','LIKE','%'.$query.'%')
            ->orwhere('idArticulos','LIKE','%'.$query.'%')
            ->orwhere('Nombre_categoria','LIKE','%'.$query.'%')
            ->orderBy('nom_articulo','asc')
            ->paginate(7);
            return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        }
    }
    public function edit($id){
        $prom=DB::table('facturas')
                                ->join('detalle_factura','idFactura','=','idFacturas')
                                ->select('idFacturas','Num_factura','idArticulo','cantidad','prom')
                                ->where("idArticulo","=",$id)
                                ->where('Estado',"!=","Cancelado")
                                ->orderBy('fecha','DESC')
                                ->first();
        if(count($prom)==0){  
            return view("almacen.articulo.edit",["articulo"=>Articulos::findOrFail($id),"categorias"=>Categorias::get(),"promedio"=>0]);
        }
        
        return view("almacen.articulo.edit",["articulo"=>Articulos::findOrFail($id),"categorias"=>Categorias::get(),"promedio"=>$prom->prom]);
    }
    public function create(){
        return view("almacen.articulo.create",["categorias"=>Categorias::get()]);
    }
    public function update(Request $request,$id){
        if($request->get('codigo')==$request->get('rcodigo')){
            $articulo=Articulos::findOrFail($id);
            $articulo->Categorias_idCategorias=$request->get('idcategoria');
            $articulo->idArticulos=$request->get('codigo');
            $articulo->nom_articulo=$request->get('nombre');
            $articulo->stock=$request->get('stock');
            $articulo->minimo=$request->get('minimo');
            $articulo->maximo=$request->get('maximo');
            $articulo->Precio_venta=str_replace(",", "",$request->get('preciov'));
            $articulo->save();
        }else{
            $articulo=Articulos::findOrFail($id);
            $articulo->delete();
            $articulo=new Articulos;
            $articulo->Categorias_idCategorias=$request->get('idcategoria');
            $articulo->idArticulos=$request->get('codigo');
            $articulo->nom_articulo=$request->get('nombre');
            $articulo->stock=$request->get('stock');
            $articulo->minimo=$request->get('minimo');
            $articulo->maximo=$request->get('maximo');
            $articulo->save();
        }
        return Redirect::to('almacen/articulo');
    }
    public function store(Request $request){
        $articulo=new Articulos;
        $articulo->Categorias_idCategorias=$request->get('idcategoria');
        $articulo->idArticulos=$request->get('codigo');
        $articulo->nom_articulo=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->minimo=$request->get('minimo');
        $articulo->maximo=$request->get('maximo');
        $articulo->save();
        return Redirect::to('almacen/articulo');
    }
    public function destroy($id){
        $articulo=Articulos::findOrFail($id);
        $articulo->Estado="Inactivo";
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
}
