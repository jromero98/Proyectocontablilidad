<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulos;

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
        $articulos=Articulos::where('stock','<','minimo')->get();
        return view('home');
    }
}
