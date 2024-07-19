<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @yield('styles')
</head>
<body>
<div class="container-fluid">
        <div class="row">
            <nav class="">
                <div class="sidebar-sticky">
                    <ul class="nav ">
                        <li><a class="navbar-brand" href="#">UTTFY</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('peliculas') }}">
                                CANCIONES
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categorias') }}">
                                ALBUMES
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productoras') }}">
                                ARTISTAS
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
    


            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                @yield('body')
            </main>
        </div>
    </div>
    @include('reproductor.navbar')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('js')
</body>
</html>