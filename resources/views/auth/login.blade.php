@extends('layouts.app') @section('content')

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                <div class="animate form login_form">
                    <section class="login_content">
                        <form role="form" method="POST" action="{{ url('/login') }}" autocomplete="off">

                            {{ csrf_field() }}

                            <h1>INICIAR SESIÓN</h1>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email"> @if ($errors->has('email'))
                                    <span class="help-block">
                 <strong>{{ $errors->first('email') }}</strong>
                 </span> @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div>
                                    <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña"> @if ($errors->has('password'))
                                    <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
                </span> @endif
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-default submit">Ingresar</button>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Olvidaste tu contraseña?</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Nuevo en el sistema?
                                    <a href="#signup" class="to_register"> Crear Cuenta </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-facebook-square"></i> ASOVIZ!</h1>
                                    <p>©2016 Todos los derechos reservados. Neonia! Privacidad y terminos.</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

                <div id="register" class="animate form registration_form">
                    <section class="login_content">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" autocomplete="off">

                            {{ csrf_field() }}

                            <h1>REGISTRARSE</h1>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Nombre"> @if ($errors->has('name'))
                                    <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
                </span> @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email"> @if ($errors->has('email'))
                                    <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
                </span> @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div>
                                    <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña"> @if ($errors->has('password'))
                                    <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
                </span> @endif
                                </div>
                            </div>

                            <div>
                                <div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmar Contraseña">
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-default submit" href="index.html">Enviar</button>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Ya eres usuario del sistema ?
                                    <a href="#signin" class="to_register"> Ingresar </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-facebook-square"></i> ASOVIZ!</h1>
                                    <p>©2016 Todos los derechos reservados. Neonia! Privacidad y terminos.</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
