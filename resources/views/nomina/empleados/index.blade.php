@extends('layouts.admin') 
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
<link rel="stylesheet" href="css/style.css">
@section('contenido')
<div class="row">
    <div class="col-xs-12" style="text-align:center">
        <h3>Listado de Empleados <a href="empleados/create"><button class="btn btn-success">Nuevo</button></a> </h3>
        @include('nomina.empleados.search')
    </div>
</div>
    <div class="row active-with-click">
        @foreach ($empleados as $empleado)
            <?php 
                switch ($empleado->color_cargo) {
                    case 1:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Red">');
                        break;
                    case 2:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Pink">');
                        break;
                    case 3:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Purple">');
                        break;
                    case 4:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Deep-Purple">');
                        break;
                    case 5:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Indigo">');
                        break;
                    case 6:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Blue">');
                        break;
                    case 7:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Cyan">');
                        break;
                    case 8:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Teal">');
                        break;
                    case 9:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Green">');
                        break;
                    case 10:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Light-Green">');
                        break;
                    case 11:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Lime">');
                        break;
                    case 12:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Yellow">');
                        break;
                    case 13:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Amber">');
                        break;
                    case 14:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Orange">');
                        break;
                    case 15:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Deep-Orange">');
                        break;
                    case 16:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Brown">');
                        break;
                    case 17:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Grey">');
                        break;
                    case 18:
                        echo('<div class="col-md-4 col-sm-6 col-xs-12">
                                <article class="material-card Blue-Grey">');
                        break;
                }
             ?>
                        <h2>
                            <span>{{$empleado->nombre_empleado}} {{$empleado->apellido_empleado}}</span>
                            <strong>
                                <i class="fa fa-fw fa-star"></i>
                                {{$empleado->nombre_cargo}}
                            </strong>
                        </h2>
                        <div class="mc-content">
                            <div class="img-container">
                                <img class="img-responsive" src="{{asset('Imagenes/Empleados/'.$empleado->foto_empleado)}}">
                            </div>
                            <div class="mc-description">
                                Cedula: {{ number_format($empleado->ced_empleado)}}<br>
                                Direccion: {{ $empleado->dir_empleado}}<br>
                                Telefono: {{ $empleado->tel_empleado}}<br>
                                Email: {{$empleado->email}}<br>
                                Salario: ${{number_format($empleado->salario_cargo)}}<br>
                            </div>
                        </div>
                        <a class="mc-btn-action">
                            <i class="fa fa-bars"></i>
                        </a>
                        <div class="mc-footer">
                            <h4>
                                Opciones
                            </h4>
                            <a class="fa fa-fw fa-pencil" title="Editar" href="{{URL::action('EmpleadoController@edit',$empleado->ced_empleado)}}"></a>
                            <a class="fa fa-fw fa-trash" title="Eliminar" href="" data-target="#modal-delete-{{$empleado->ced_empleado}}" data-toggle="modal"></a>
                        </div>
                    </article>
                </div>
                @include('nomina.empleados.modal')
    @endforeach





        <!--div class="col-md-4 col-sm-6 col-xs-12">
            <article class="material-card Red">
                <h2>
                    <span>Andres Felipe Diaz Correa</span>
                    <strong>
                        <i class="fa fa-fw fa-star"></i>
                        The Deer Hunter
                    </strong>
                </h2>
                <div class="mc-content">
                    <div class="img-container">
                        <img class="img-responsive" src="http://u.lorenzoferrara.net/marlenesco/material-card/thumb-christopher-walken.jpg">
                    </div>
                    <div class="mc-description">
                        He has appeared in more than 100 films and television shows, including The Deer Hunter, Annie Hall, The Prophecy trilogy, The Dogs of War ...
                    </div>
                </div>
                <a class="mc-btn-action">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="mc-footer">
                    <h4>
                        Social
                    </h4>
                    <a class="fa fa-fw fa-facebook"></a>
                    <a class="fa fa-fw fa-twitter"></a>
                    <a class="fa fa-fw fa-linkedin"></a>
                    <a class="fa fa-fw fa-google-plus"></a>
                </div>
            </article>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <article class="material-card Pink">
                <h2>
                    <span>Lisney Julieth Matos Vasquez</span>
                    <strong>
                        <i class="fa fa-fw fa-star"></i>
                        Mystic River
                    </strong>
                </h2>
                <div class="mc-content">
                    <div class="img-container">
                        <img class="img-responsive" src="http://u.lorenzoferrara.net/marlenesco/material-card/thumb-sean-penn.jpg">
                    </div>
                    <div class="mc-description">
                        He has won two Academy Awards, for his roles in the mystery drama Mystic River (2003) and the biopic Milk (2008). Penn began his acting career in television with a brief appearance in a 1974 episode of Little House on the Prairie ...
                    </div>
                </div>
                <a class="mc-btn-action">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="mc-footer">
                    <h4>
                        Social
                    </h4>
                    <a class="fa fa-fw fa-facebook"></a>
                    <a class="fa fa-fw fa-twitter"></a>
                    <a class="fa fa-fw fa-linkedin"></a>
                    <a class="fa fa-fw fa-google-plus"></a>
                </div>
            </article>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <article class="material-card Purple">
                <h2>
                    <span>Juan Carlos Pinzon Gonzales</span>
                    <strong>
                        <i class="fa fa-fw fa-star"></i>
                        Million Dollar Baby
                    </strong>
                </h2>
                <div class="mc-content">
                    <div class="img-container">
                        <img class="img-responsive" src="http://u.lorenzoferrara.net/marlenesco/material-card/thumb-clint-eastwood.jpg">
                    </div>
                    <div class="mc-description">
                        He rose to international fame with his role as the Man with No Name in Sergio Leone's Dollars trilogy of spaghetti Westerns during the 1960s ...
                    </div>
                </div>
                <a class="mc-btn-action">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="mc-footer">
                    <h4>
                        Social
                    </h4>
                    <a class="fa fa-fw fa-facebook"></a>
                    <a class="fa fa-fw fa-twitter"></a>
                    <a class="fa fa-fw fa-linkedin"></a>
                    <a class="fa fa-fw fa-google-plus"></a>
                </div>
            </article>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <article class="material-card Deep-Purple">
                <h2>
                    <span>Luis Miguel Herrera Monrroy</span>
                    <strong>
                        <i class="fa fa-fw fa-star"></i>
                        Kramer vs. Kramer
                    </strong>
                </h2>
                <div class="mc-content">
                    <div class="img-container">
                        <img class="img-responsive" src="http://u.lorenzoferrara.net/marlenesco/material-card/thumb-dustin-hoffman.jpg">
                    </div>
                    <div class="mc-description">
                        He has been known for his versatile portrayals of antiheroes and vulnerable characters.[3] He won the Academy Award for Kramer vs. Kramer in 1979 ...
                    </div>
                </div>
                <a class="mc-btn-action">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="mc-footer">
                    <h4>
                        Social
                    </h4>
                    <a class="fa fa-fw fa-facebook"></a>
                    <a class="fa fa-fw fa-twitter"></a>
                    <a class="fa fa-fw fa-linkedin"></a>
                    <a class="fa fa-fw fa-google-plus"></a>
                </div>
            </article>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <article class="material-card Indigo">
                <h2>
                    <span>Jorge Enrique Romero Cortes</span>
                    <strong>
                        <i class="fa fa-fw fa-star"></i>
                        American History X
                    </strong>
                </h2>
                <div class="mc-content">
                    <div class="img-container">
                        <img class="img-responsive" src="http://u.lorenzoferrara.net/marlenesco/material-card/thumb-edward-norton.jpg">
                    </div>
                    <div class="mc-description">
                        He has been nominated for three Academy Awards for his work in the films Primal Fear, American History X and Birdman. He also starred in other roles ...
                    </div>
                </div>
                <a class="mc-btn-action">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="mc-footer">
                    <h4>
                        Social
                    </h4>
                    <a class="fa fa-fw fa-facebook"></a>
                    <a class="fa fa-fw fa-twitter"></a>
                    <a class="fa fa-fw fa-linkedin"></a>
                    <a class="fa fa-fw fa-google-plus"></a>
                </div>
            </article>
        </div-->
    </div>
    <div class="form-group text-center">
        {{$empleados->appends(Request::only(['searchText']))->render()}}
</div>
@endsection
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
