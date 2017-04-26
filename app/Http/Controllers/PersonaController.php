<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Http\Requests\PersonaFromRequest;

class PersonaController extends Controller
{
	public function index(Request $request){
		if($request->ajax()){
			$personas=Persona::get();
			return response()->json($personas);
		}
	}
    public function store(PersonaFromRequest $request){
    	if($request->ajax()){
    		Persona::create($request->all());
    		return response()->json([
    			"Mensaje" => "confirmar"
    		]);
    	}
    }
}
