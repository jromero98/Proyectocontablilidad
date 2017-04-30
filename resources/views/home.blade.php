@extends('layouts.admin')

<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
<link rel="stylesheet" href="css/pmain.css">
@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Hola {{ Auth::user()->name }} Bienvenido a Asoviz</div>

                <div class="panel-body">
            <article class="full-width tile">
                <div class="tile-text">
                    <span class="text-condensedLight">
                        {{count($admin)}}<br>
                        <small>Administratores</small>
                    </span>
                </div>
                <i class="zmdi zmdi-account tile-icon"></i>
            </article>
            <article class="full-width tile">
                <div class="tile-text">
                    <span class="text-condensedLight">
                        {{count($clientes)}}<br>
                        <small>Clientes</small>
                    </span>
                </div>
                <i class="zmdi zmdi-accounts tile-icon"></i>
            </article>
            <article class="full-width tile">
                <div class="tile-text">
                    <span class="text-condensedLight">
                        {{count($proveedores)}}<br>
                        <small>Proveedores</small>
                    </span>
                </div>
                <i class="zmdi zmdi-truck tile-icon"></i>
            </article>
            <article class="full-width tile">
                <div class="tile-text">
                    <span class="text-condensedLight">
                        {{count($categorias)}}<br>
                        <small>Categorias</small>
                    </span>
                </div>
                <i class="zmdi zmdi-label tile-icon"></i>
            </article>
            <article class="full-width tile">
                <div class="tile-text">
                    <span class="text-condensedLight">
                        {{count($articulos)}}<br>
                        <small>Productos</small>
                    </span>
                </div>
                <i class="zmdi zmdi-washing-machine tile-icon"></i>
            </article>
            <article class="full-width tile">
                <div class="tile-text">
                    <span class="text-condensedLight">
                        {{count($ventas)}}<br>
                        <small>Ventas</small>
                    </span>
                </div>
                <i class="zmdi zmdi-shopping-cart tile-icon"></i>
            </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection