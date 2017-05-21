<link href="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="css/stylehome.css"> 
<style type="text/css">
    a{
        color: #FFF;
    }
</style>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="containere">
                            <header>
                                <div class="bio">
                                    <img src="administradores.png" style="" alt="background" class="bg">
                                    <div class="desc">
                                        <br><br><br>
                                        <h3>Administradores</h3>
                                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis fugiat eius, cupiditate iste similique porro officia necessitatibus ad corporis debitis ipsum perferendis, optio dolorem, delectus blanditiis totam quos sunt at.</p> -->
                                    </div>
                                </div>
                                <div class="avatarcontainer">
                                    <img src="http://www.croop.cl/UI/twitter/images/carl.jpg" alt="avatar" class="avatars">
                                    <div class="hover">
                                        <div class="icon-user"></div>
                                    </div>
                                </div>
                            </header>
                            <div class="content">
                                <div class="data">
                                    <ul>
                                    <li></li>
                                        <li>
                                            {{count($admin)}}
                                            <span>Administradores Actuales</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="follow">
                                    <div class="icon-eye-open"></div> Ver</div>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="containere">
                                <header>
                                    <div class="bio">
                                        <img src="clientes.jpg" alt="background" class="bg">
                                        <div class="desc">
                                            <br><br><br>
                                            <h3>Clientes</h3>
                                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores saepe itaque ratione commodi nulla, aliquid fuga provident animi unde labore magnam tempore obcaecati dolor quae accusamus consequatur. Ea, minus, magnam?</p>
                                            </div> -->
                                        </div>

                                        <div class="avatarcontainer">
                                            <img src="http://www.croop.cl/UI/twitter/images/carl.jpg" alt="avatar" class="avatars">
                                            <div class="hover">
                                                <div class="icon-group"></div>
                                            </div>
                                        </div>
                                    </div>
                                </header>

                                <div class="content">
                                    <div class="data">
                                        <ul>
                                        <li></li>
                                            <li>
                                                {{count($clientes)}}
                                                <span>Total de Clientes</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="follow">
                                        <div class="icon-eye-open"></div> Ver</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="containere">
                                <header>
                                    <div class="bio">
                                        <img src="proveedores.jpg" alt="background" class="bg">
                                        <div class="desc">
                                            <br><br><br>
                                            <h3>Proveedores</h3>
                                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo cum, nihil, itaque, aliquam veritatis esse iure rem laudantium repudiandae in, sit nisi ipsa voluptas consectetur sapiente quas. Aperiam exercitationem, quo?</p>
                                             </div> -->
                                        </div>

                                        <div class="avatarcontainer">
                                            <img src="http://www.croop.cl/UI/twitter/images/carl.jpg" alt="avatar" class="avatars">
                                            <div class="hover">
                                                <div class="icon-truck"></div>
                                            </div>
                                        </div>
                                    </div>
                                </header>
                                <div class="content">
                                    <div class="data">
                                        <ul>
                                        <li></li>
                                            <li>
                                                {{count($proveedores)}}
                                                <span>Total de Proveedores</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="follow">
                                        <div class="icon-eye-open"></div> Ver</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="containere">
                                <header>
                                    <a href="/almacen/categoria">
                                    <div class="bio">
                                        <img src="categorias.png" alt="background" class="bg">
                                        <div class="desc">
                                            <br><br><br>
                                            <h3>Categorias</h3>
                                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis ad cumque, optio voluptas, recusandae sit nobis soluta dignissimos quam. Saepe molestias fugit dicta mollitia voluptatum. Eligendi aliquam, blanditiis quia molestias.</p> -->
                                        </div>
                                    </div>
                                    </a>
                                    <div class="avatarcontainer">
                                        <img src="http://www.croop.cl/UI/twitter/images/carl.jpg" alt="avatar" class="avatars">
                                        <div class="hover">
                                            <div class="icon-tags"></div>
                                        </div>
                                    </div>
                                </header>

                                <div class="content">
                                    <div class="data">
                                        <ul>
                                        <li></li>
                                            <li>
                                                {{count($categorias)}}
                                                <span>Categorias Activas</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="/almacen/categoria">
                                    <div class="follow">
                                        <div class="icon-eye-open"></div> Ver</div></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="containere">
                                <header>
                                    <a href="/almacen/articulo">
                                    <div class="bio">
                                        <img src="productos.jpg" alt="background" class="bg">
                                        <div class="desc">
                                            <br><br><br>
                                            <h3>Productos</h3>
                                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic omnis atque sequi saepe laboriosam mollitia, quo culpa magni aliquid labore quisquam nesciunt! Impedit quae beatae incidunt voluptatum praesentium culpa alias.</p> -->
                                        </div>
                                    </div>
                                    </a>
                                    <div class="avatarcontainer">
                                        <img src="http://www.croop.cl/UI/twitter/images/carl.jpg" alt="avatar" class="avatars">
                                        <div class="hover">
                                            <div class="icon-leaf"></div>
                                        </div>
                                    </div>
                                </header>

                                <div class="content">
                                    <div class="data">
                                        <ul>
                                        <li></li>
                                            <li>
                                                {{count($articulos)}}
                                                <span>Productos Activos</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="/almacen/articulo">
                                    <div class="follow">
                                        <div class="icon-eye-open"></div> Ver</div></a>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                            <div class="containere">
                                <header>
                                    <a href="/ventas?searchText=&estado=Pagado">
                                    <div class="bio">
                                        <img src="ventas.jpg" alt="background" class="bg">
                                        <div class="desc">
                                            <br><br><br>
                                            <h3>Ventas</h3>
                                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum suscipit iste tempore voluptate explicabo, cumque consequuntur alias reprehenderit perferendis, voluptates et. Ab, doloremque nobis autem cum dignissimos porro itaque praesentium.</p> -->
                                        </div>
                                    </div>
                                    </a>
                                    <div class="avatarcontainer">
                                        <img src="http://www.croop.cl/UI/twitter/images/carl.jpg" alt="avatar" class="avatars">
                                        <div class="hover">
                                            <div class="icon-shopping-cart "></div>
                                        </div>
                                    </div>


                                </header>

                                <div class="content">
                                    <div class="data">
                                        <ul>
                                            <li></li>
                                            <li>
                                                {{count($ventas)}}
                                                <span>Ventas Totales</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="/ventas?searchText=&estado=Pagado">
                                    <div class="follow">
                                        <div class="icon-eye-open"></div> Ver</div></a>
                                </div>
                            </div>
                        </div>