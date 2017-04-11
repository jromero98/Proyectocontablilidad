@extends('layouts.admin') 

@section('contenido')
<br/>
<div class="content-header">
    <h1>Error 404</h1>
</div>

<div class="widget-content">
    <div class="error_ex">
        <h1>404</h1>
        <h3>Vaya, estás perdido.</h3>
        <p>No podemos encontrar la página que estás buscando.</p>
        <a class="btn btn-warning btn-big" href="/home">Volver al inicio</a>
    </div>
</div>
@endsection
