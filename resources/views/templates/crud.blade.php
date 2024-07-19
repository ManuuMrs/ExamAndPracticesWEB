<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @yield('styles')
    <style>
        body {
            background-color: #343a40;
            color: #f8f9fa;
        }
        .navbar {
            background-color: #495057;
        }
        .navbar-nav .nav-link {
            color: #f8f9fa;
        }
        .navbar-nav .nav-link:hover {
            color: #dc3545;
        }
        .sidebar {
            background-color: #495057;
        }
        .sidebar .nav-link {
            color: #f8f9fa;
        }
        .sidebar .nav-link:hover {
            color: #dc3545;
        }
        .table {
            color: #f8f9fa;
        }
        .table thead {
            background-color: #495057;
        }
        .table thead th {
            color: #dc3545;
        }
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-primary:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .modal-content {
            background-color: #343a40;
            color: #f8f9fa;
        }
        .modal-header {
            border-bottom: 1px solid #495057;
        }
        .modal-footer {
            border-top: 1px solid #495057;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        <i class="fas fa-user"></i> User
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('peliculas') }}">
                                Videojuegos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categorias') }}">
                                Categorías
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productoras') }}">
                                Desarrolladora
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/view/json">
                                JSON Dinámico
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/view/colors">
                                Colors
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('js')
</body>
</html>
