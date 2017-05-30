<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulos;
use App\Persona;
use App\Facturas;
use App\Categorias;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vivero = DB::table('datosvivero')->select('nom_vivero')->first();
        $articulos=Articulos::where('estado','=','Activo')->where("stock",">","0")->get();
        $clientes=Persona::where('tipo','=','Cliente')->get();
        $proveedores=Persona::where('tipo','=','Proveedor')->get();
        $categorias=Categorias::get();
        $ventas=Facturas::where('estado','=','Pagado')->where("tipo_factura","=","Fv")->get();
        $admin=DB::table("role_user")->where("role_id","=","1")->get();
        return view('home', compact('clientes', 'proveedores','ventas','articulos','categorias','admin',"vivero"));
    }
}
