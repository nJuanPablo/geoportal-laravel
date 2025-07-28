<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!doctype html>
<html lang="en">
    <head>
        <title>@yield('title', 'Mi App')</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
        @yield('css')
        
        <style>
            .dropdown-menu {
                z-index: 1051 !important; /* Bootstrap dropdown usa 1000-1050 */
                position: absolute;
            }
            #map {
                z-index: 0;
            }
        </style>
    
    </head>

    <body class="d-flex flex-column min-vh-100">
        <header>
            <nav class="navbar2 navbar-expand-lg bg-personalizadonav navbar-compact">
                    <div class="container-fluid d-flex align-items-center justify-content-between">

                        <div class="px-4">
                            <div class="dropdown">
                                <button class="btn btn-outline-light dropdown-toggle btn-sm" data-bs-toggle="dropdown">
                                Módulos
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/geovisor">Geovisor</a></li>
                                    <li><a class="dropdown-item" href="#">Tierras</a></li>
                                    <li><a class="dropdown-item" href="#">Minas</a></li>
                                    <li><a class="dropdown-item" href="#">Sistema de salud</a></li>
                                    <li><a class="dropdown-item" href="#">Mujer, familia y género</a></li>
                                </ul>
                            </div>
                        </div>
                    
                        <a href="/home" class="navbar-brand2 mx-auto text-white align-items-center mb-2 d-flex" style="font-size: 1.5rem; font-weight: bold; text-decoration: none;">
                            <i class="fas fa-globe " style="font-size: 1.5rem; font-weight: bold; "></i>    
                            <span class="ms-2">GeoPortal</span>
                        </a>

                        <div class="px-4">
                            <!-- Aquí puedes agregar otro botón o dejarlo vacío -->
                            <div class="dropdown">
                                <button class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-user"></i>
                                    <span class="ms-2">
                                        @auth
                                            {{ auth()->user()->name ?? auth()->user()->username }}
                                        @else
                                            Usuario
                                        @endauth
                                    </span>
                                </button>
                                <ul class="dropdown-menu">
                                    @auth
                                    <li><a class="dropdown-item " href="/logout">Cerrar sesión</a></li>
                                    @else
                                    <li><a class="dropdown-item" href="/login">Iniciar sesión</a></li>
                                    <li><a class="dropdown-item" href="/register">Registrarse</a></li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
            </nav>
            
        </header>
        <main class="flex-grow-1">
            <!-- Contenido específico de cada página -->
                @yield('content')
        </main>
        
        <!-- Remove the container if you want to extend the Footer to full width. -->
        <div class="">
            <!-- Footer -->
            <footer
                    class="text-center text-lg-start text-white"
                    style="background-color: #45806c"
                    id="sobre-nosotros"
                    >
                <!-- Grid container -->
                <div class="container p-4 pb-0">
                <!-- Section: Links -->
                <section class="">
                    <!--Grid row-->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">
                            Compañía
                            </h6>
                            <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. \
                            Ipsa quod provident architecto voluptate rerum quia reiciendis odit animi aut, 
                            atque distinctio aliquid maxime eligendi minus. 
                            Nihil fuga consectetur molestias? Provident!
                            </p>
                        </div>
                        <!-- Grid column -->

                        <hr class="w-100 clearfix d-md-none" />

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Enlaces rápidos</h6>
                            
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white text-decoration-none">Acerca de</a></li>
                                <li><a href="#" class="text-white text-decoration-none">Mapa</a></li>
                                <li><a href="#" class="text-white text-decoration-none">Capas disponibles</a></li>
                            </ul>
                        </div>
                        <!-- Grid column -->

                        <hr class="w-100 clearfix d-md-none" />

                        <!-- Grid column -->
                        <hr class="w-100 clearfix d-md-none" />

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Contactos</h6>
                            <p><i class="fas fa-home mr-3"></i> Bogota, Colombia</p>
                            <p><i class="fas fa-envelope mr-3"></i> info@outlook.com</p>
                            <p><i class="fas fa-phone mr-3"></i> + 57 300 567 00 88</p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Follow us</h6>

                            <!-- Facebook -->
                            <a
                            class="btn btn-primary btn-floating m-1 btn-icon"
                            style="background-color: #3b5998"
                            href="https://www.facebook.com"
                            role="button"
                            ><i class="fab fa-facebook-f"></i
                            ></a>

                            <!-- Twitter -->
                            <a
                            class="btn btn-primary btn-floating m-1 btn-icon"
                            style="background-color: #55acee"
                            href="https://www.X.com"
                            role="button"
                            ><i class="fab fa-twitter"></i
                            ></a>

                            <!-- Google -->
                            <a
                            class="btn btn-primary btn-floating m-1 btn-icon"
                            style="background-color: #da432f"
                            href="https://www.google.com"
                            role="button"
                            ><i class="fab fa-google"></i
                            ></a>

                            <!-- Instagram -->
                            <a
                            class="btn btn-primary btn-floating m-1 btn-icon"
                            style="background-color: #ac2bac"
                            href="https://www.instagram.com"
                            role="button"
                            ><i class="fab fa-instagram"></i
                            ></a>

                            <!-- Linkedin -->
                            <a
                            class="btn btn-primary btn-floating m-1 btn-icon"
                            style="background-color: #0082ca"
                            href="https://www.linkedin.com"
                            role="button"
                            ><i class="fab fa-linkedin-in"></i
                            ></a>
                            <!-- Github -->
                            <a
                            class="btn btn-primary btn-floating m-1 btn-icon"
                            style="background-color: #333333"
                            href="https://www.github.com"
                            role="button"
                            ><i class="fab fa-github"></i
                            ></a>
                        </div>
                    </div>
                    <!--Grid row-->
                </section>
                <!-- Section: Links -->
                </div>
                <!-- Grid container -->

                <!-- Copyright -->
                <div
                    class="text-center p-3"
                    style="background-color: rgba(0, 0, 0, 0.2)"
                    >
                © 2025 Copyright:
                <a class="text-white" href="https://www.opiac.org.co/"
                    >opiac.org.co</a
                    >
                </div>
                <!-- Copyright -->
            </footer>
            <!-- Footer -->
        </div>
        <!-- End of .container -->

        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>

        <script src="https://kit.fontawesome.com/2839a934dd.js" crossorigin="anonymous"></script>

        @stack('javascripts')
    </body>
</html>
