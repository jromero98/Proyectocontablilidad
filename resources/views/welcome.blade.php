<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Grateful Dogs</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="/css/main.css" rel="stylesheet">
        <link href="/css/font-awesome.css" rel="stylesheet">


        <!-- Styles -->
        <style>
            .full-height {
                height: 0vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .links > a {
                color: white;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>

    </head>
    <body>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Iniciar Sesion</a>
                    <!-- <a href="{{ url('/register') }}">Registrarse</a> -->
                </div>
            @endif
        </div>


        <!-- Header -->
            <div id="header">

                <div class="top">

                    <!-- Logo -->
                        <div id="logo">
                            <span class="image avatar48"><img src="images/avatar.png" alt="" /></span>
                            <h1 id="title">Grateful Dogs</h1>
                            <p>Descripción</p>
                        </div>

                    <!-- Nav -->
                        <nav id="nav">
        
                            <ul>
                                <li><a href="#Intro" id="Intro-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Intro</span></a></li>
                                <li><a href="#Galeria" id="Galeria-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Galería</span></a></li>
                                <li><a href="#Acerca" id="Acerca-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Acerca De </span></a></li>
                                <li><a href="#Contacto" id="Contacto-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Contacto</span></a></li>
                            </ul>
                        </nav>

                </div>

                <div class="bottom">

                    <!-- Social Icons -->
                        <ul class="icons">
                            <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                            <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                            <li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
                            <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
                            <li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
                        </ul>

                </div>

            </div>

        <!-- Main -->
            <div id="main">

                <!-- Intro -->
                    <section id="Intro" class="one dark cover">
                        <div class="container">

                            <header>
                                <!-- <h2 class="alt">Hi! I'm <strong>Prologue</strong>, a <a href="http://html5up.net/license">free</a> responsive<br />
                                site template designed by <a href="http://html5up.net">HTML5 UP</a>.</h2>
                                <p>Ligula scelerisque justo sem accumsan diam quis<br />
                                vitae natoque dictum sollicitudin elementum.</p> -->
                            </header>

                            <footer>
                                <a href="#portfolio" class="button scrolly">Registrar</a>
                            </footer>

                        </div>
                    </section>

                <!-- Portfolio -->
                    <section id="Galeria" class="two">
                        <div class="container">

                            <header>
                                <h2>Galería</h2>
                            </header>

                            <p>Vitae natoque dictum etiam semper magnis enim feugiat convallis convallis
                            egestas rhoncus ridiculus in quis risus amet curabitur tempor orci penatibus.
                            Tellus erat mauris ipsum fermentum etiam vivamus eget. Nunc nibh morbi quis
                            fusce hendrerit lacus ridiculus.</p>

                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, quis, eum. Nemo fugiat expedita nesciunt dignissimos. Iure temporibus velit corporis, nisi sunt perspiciatis delectus quibusdam repellat et. Consequuntur, omnis, magnam. paty es estupida y no confia en mi...</p>

                            <div class="row">
                                <div class="4u 12u$(mobile)">
                                    <article class="item">
                                        <a href="#" class="image fit"><img src="images/pic02.png" alt="" /></a>
                                        <header>
                                            <h3>Ipsum Feugiat</h3>
                                        </header>
                                    </article>
                                    <article class="item">
                                        <a href="#" class="image fit"><img src="images/pic03.png" alt="" /></a>
                                        <header>
                                            <h3>Rhoncus Semper</h3>
                                        </header>
                                    </article>
                                </div>
                                <div class="4u 12u$(mobile)">
                                    <article class="item">
                                        <a href="#" class="image fit"><img src="images/pic04.png" alt="" /></a>
                                        <header>
                                            <h3>Magna Nullam</h3>
                                        </header>
                                    </article>
                                    <article class="item">
                                        <a href="#" class="image fit"><img src="images/pic05.png" alt="" /></a>
                                        <header>
                                            <h3>Natoque Vitae</h3>
                                        </header>
                                    </article>
                                </div>
                                <div class="4u$ 12u$(mobile)">
                                    <article class="item">
                                        <a href="#" class="image fit"><img src="images/pic06.png" alt="" /></a>
                                        <header>
                                            <h3>Dolor Penatibus</h3>
                                        </header>
                                    </article>
                                    <article class="item">
                                        <a href="#" class="image fit"><img src="images/pic07.png" alt="" /></a>
                                        <header>
                                            <h3>Orci Convallis</h3>
                                        </header>
                                    </article>
                                </div>
                            </div>

                        </div>
                    </section>

                <!-- About Me -->
                    <section id="Acerca" class="three">
                        <div class="container">

                            <header>
                                <h2>Acerca del proyecto:</h2>
                            </header>

                            <a href="#" class="image featured"><img src="images/pic08.jpg" alt="" /></a>

                            <p>Tincidunt eu elit diam magnis pretium accumsan etiam id urna. Ridiculus
                            ultricies curae quis et rhoncus velit. Lobortis elementum aliquet nec vitae
                            laoreet eget cubilia quam non etiam odio tincidunt montes. Elementum sem
                            parturient nulla quam placerat viverra mauris non cum elit tempus ullamcorper
                            dolor. Libero rutrum ut lacinia donec curae mus vel quisque sociis nec
                            ornare iaculis.</p>

                        </div>
                    </section>

                <!-- Contact -->
                    <section id="Contacto" class="four">
                        <div class="container">

                            <header>
                                <h2>Contacto:</h2>
                            </header>

                            <p>Elementum sem parturient nulla quam placerat viverra
                            mauris non cum elit tempus ullamcorper dolor. Libero rutrum ut lacinia
                            donec curae mus. Eleifend id porttitor ac ultricies lobortis sem nunc
                            orci ridiculus faucibus a consectetur. Porttitor curae mauris urna mi dolor.</p>

                            <form method="post" action="#">
                                <div class="row">
                                    <div class="6u 12u$(mobile)"><input type="text" name="name" placeholder="Name" /></div>
                                    <div class="6u$ 12u$(mobile)"><input type="text" name="email" placeholder="Email" /></div>
                                    <div class="12u$">
                                        <textarea name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="12u$">
                                        <input type="submit" value="Enviar mensaje" />
                                    </div>
                                </div>
                            </form>

                        </div>
                    </section>

            </div>

        <!-- Footer -->
            <div id="footer">

                <!-- Copyright -->
                    <ul class="copyright">
                        <!-- <li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li> -->
                    </ul>

            </div>

        <!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery.scrolly.min.js"></script>
            <script src="assets/js/jquery.scrollzer.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/util.js"></script>
            <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
            <script src="assets/js/main.js"></script>
    </body>
</html>
