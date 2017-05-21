<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\User;
use DB;

class PerfilController extends Controller
{
    public function index(){
    	$usuario=\Auth::user();
    	$rol=DB::table('roles')
    		->join('role_user','role_id','=','id')
    		->select('id','display_name')
    		->where('user_id','=',$usuario->id)
    		->first();
    	$permisos=DB::table('permissions')
    		->join('permission_role','permission_id','=','id')
    		->select('display_name','description')
    		->where('role_id','=',$rol->id)
    		->orderBy('display_name')
    		->get();
         return view('perfil.index', compact('usuario','rol','permisos'));
    }
    public function update(Request $request,$id){
            $usuario=User::findOrFail($id);
            $usuario->name=$request->get('nombre');
            $usuario->Direccion=$request->get('direccion');
            if (Input::hasFile('image')){
                $file=Input::file('image');
                $file->move(public_path().'/Imagenes/Usuarios/',$id.$file->getClientOriginalName());
                $usuario->img=$id.$file->getClientOriginalName();
            }
            $usuario->save();
        return Redirect::to('/home');
    }
}
