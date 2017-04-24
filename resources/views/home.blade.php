@extends('layouts.admin')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Hola {{ Auth::user()->name }}</div>

                <div class="panel-body">
                    Bienvenido a Asoviz
                </div>
            </div>
        </div>
    </div>
</div>
@endsection