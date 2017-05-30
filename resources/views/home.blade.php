@extends('layouts.admin')
@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Hola {{ Auth::user()->name }} Bienvenido a {{$vivero->nom_vivero}}</div>

                <div class="panel-body">
            @include('estadistica')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection