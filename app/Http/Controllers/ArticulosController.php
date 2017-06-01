<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticuloFormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Articulos;
use App\Categorias;
use DB;

class ArticulosController extends Controller
{
    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $articulos=DB::table('articulos')->join('categorias','categorias_idcategorias','=','idcategorias')
            ->select('nom_articulo','idarticulos','color','stock','idcategorias','nombre_categoria','minimo','maximo','estado','precio_venta','imagen')
            ->where('nom_articulo','LIKE','%'.$query.'%')
            ->orwhere('idarticulos','LIKE','%'.$query.'%')
            ->orwhere('nombre_categoria','LIKE','%'.$query.'%')
            ->orderBy('nom_articulo','asc')
            ->paginate(6);
            return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        }
    }
    public function edit($id){
        $prom=DB::table('facturas')
                                ->join('detalle_factura','idfactura','=','idfacturas')
                                ->select('idfacturas','num_factura','idarticulo','cantidad','prom')
                                ->where("idarticulo","=",$id)
                                ->where('estado',"!=","Cancelado")
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
    public function update(ArticuloFormRequest $request,$id){
        if($request->get('codigo')==$request->get('rcodigo')){
            $articulo=Articulos::findOrFail($id);
            $articulo->Categorias_idCategorias=$request->get('idcategoria');
            $articulo->idarticulos=$request->get('codigo');
            $articulo->nom_articulo=$request->get('nombre');
            $articulo->stock=$request->get('stock');
            $articulo->minimo=$request->get('minimo');
            $articulo->maximo=$request->get('maximo');
            $articulo->Precio_venta=str_replace(",", "",$request->get('preciov'));
            if (Input::hasFile('image')){
                $file=Input::file('image');
                $file->move(public_path().'/Imagenes/Articulos/',$request->get('codigo').$file->getClientOriginalName());
                $articulo->Imagen=$request->get('codigo').$file->getClientOriginalName();
            }
            $articulo->save();
        }else{
            $articulo=Articulos::findOrFail($id);
            $articulo->delete();
            $articulo=new Articulos;
            $articulo->Categorias_idCategorias=$request->get('idcategoria');
            $articulo->idarticulos=$request->get('codigo');
            $articulo->nom_articulo=$request->get('nombre');
            $articulo->stock=$request->get('stock');
            $articulo->minimo=$request->get('minimo');
            $articulo->maximo=$request->get('maximo');
            $articulo->Precio_venta=str_replace(",", "",$request->get('preciov'));
            if (Input::hasFile('image')){
                $file=Input::file('image');
                $file->move(public_path().'/Imagenes/Articulos/',$request->get('codigo').$file->getClientOriginalName());
                $articulo->Imagen=$request->get('codigo').$file->getClientOriginalName();
            }
            $articulo->save();
        }
        return Redirect::to('almacen/articulo');
    }
    public function store(ArticuloFormRequest $request){
        $articulo=new Articulos;
        $articulo->Categorias_idCategorias=$request->get('idcategoria');
        $articulo->idarticulos=$request->get('codigo');
        $articulo->nom_articulo=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->minimo=$request->get('minimo');
        $articulo->maximo=$request->get('maximo');
        $articulo->Precio_venta=str_replace(",", "",$request->get('preciov'));
        if (Input::hasFile('image')){
            $file=Input::file('image');
            $file->move(public_path().'/Imagenes/Articulos/',$request->get('codigo').$file->getClientOriginalName());
            $articulo->Imagen=$request->get('codigo').$file->getClientOriginalName();
        }else{
            $articulo->Imagen="blanco.png";
        }
        $articulo->save();
        return Redirect::to('almacen/articulo');
    }
    public function destroy($id){
        $articulo=Articulos::findOrFail($id);
        $articulo->estado="Inactivo";
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
}
