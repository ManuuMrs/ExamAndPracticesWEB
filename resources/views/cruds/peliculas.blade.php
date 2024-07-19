@extends('layouts.welcome')

@section('content')

@extends('templates.crud')

@section('styles')
<style>
    body {
        background-color: #343a40;
        color: #f8f9fa;
    }

    .table {
        background-color: transparent;
        color: #f8f9fa;
    }

    .table th, .table td {
        color: #f8f9fa;
    }

    .table-dark {
        background-color: #495057;
    }

    .modal-content {
        background-color: #495057;
        color: #f8f9fa;
    }

    .modal-header, .modal-footer {
        border-bottom: 1px solid #6c757d;
    }

    .form-control {
        background-color: #6c757d;
        color: #f8f9fa;
        border: 1px solid #495057;
    }

    .form-control::placeholder {
        color: #adb5bd;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-primary:hover, .btn-secondary:hover {
        opacity: 0.8;
    }

    .text-center {
        text-align: center;
    }

    .text-center td, .text-center th {
        text-align: center;
    }
</style>
@endsection

@section('title', 'Peliculas')

@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}">
<h1 class="h2 text-center">CANCIONES</h1>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#peliculaModal" onclick="clearForm()">
        Añadir
    </button>
</div>

<div class="form-inline centrar-horizontal mb-2">
    <input type="text" id="search-input" class="form-control" placeholder="Buscar por título...">

    <button id="search-btn" class="btn btn-secondary"><i class="bi bi-search"></i></button>
</div>

<table class="table table-striped table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Duración</th>
            <th>Artista</th>
            <th>Álbum</th>
            <th>Editar/Eliminar</th>
        </tr>
    </thead>
    <tbody id="peliculasTableBody">
    </tbody>
</table>

<div class="modal fade" id="peliculaModal" tabindex="-1" aria-labelledby="peliculaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="peliculaForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="peliculaModalLabel">Añadir/Editar Canción</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="pelicula_id" name="pelicula_id">

                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="lanzamiento">Duración</label>
                        <input type="text" class="form-control" id="lanzamiento" name="lanzamiento" required>
                    </div>
                    <div class="form-group">
                        <label for="productora_id">Desarrolladora</label>
                        <select class="form-control" id="productora_id" name="productora_id" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoria_id">Categoría</label>
                        <select class="form-control" id="categoria_id" name="categoria_id" required>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var peliculas = [];

    $(document).ready(function () {
        fetchPeliculas();
        fetchProductoras();
        fetchCategorias();

        $('#peliculaForm').on('submit', function (e) {
            e.preventDefault();

            let id = $('#pelicula_id').val();
            let url = id ? `/update/pelicula/${id}` : '/insert/pelicula';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: $('#peliculaForm').serialize(),
                success: function (response) {
                    $('#peliculaModal').modal('hide');
                    fetchPeliculas();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });

        $('#search-btn').on('click', function () {
            applyFilters();
        });
    });

    function fetchPeliculas(order = 'asc') {
        $.get(`/get/peliculas?order=${order}`, function (data) {
            peliculas = data;
            renderPeliculas(peliculas);
        });
    }

    function renderPeliculas(data) {
        let tableBody = $('#peliculasTableBody');
        tableBody.empty();
        data.forEach(pelicula => {
            tableBody.append(`
                <tr>
                    <td>${pelicula.id}</td>
                    <td>${pelicula.titulo}</td>
                    <td>${pelicula.lanzamiento}</td>
                    <td>${pelicula.productora ? pelicula.productora.nombre : 'N/A'}</td>
                    <td>${pelicula.categoria ? pelicula.categoria.nombre : 'N/A'}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="playSong(${ pelicula.id })">Play</button>
                        <button class="btn btn-warning" onclick="editPelicula(${pelicula.id})"><i class="bi bi-pencil-fill"></i></button>
                        <button class="btn btn-danger" onclick="deletePelicula(${pelicula.id})"><i class="bi bi-backspace-fill"></i></button>
                    </td>
                </tr>
            `);
        });
    }

    function applyFilters() {
        let searchValue = $('#search-input').val().toLowerCase();
        let startDate = $('#start-date').val();
        let endDate = $('#end-date').val();

        let filteredPeliculas = peliculas.filter(function (pelicula) {
            let match = true;

            if (searchValue) {
                match = pelicula.titulo.toLowerCase().includes(searchValue);
            }

            if (startDate) {
                match = match && (pelicula.lanzamiento >= startDate);
            }

            if (endDate) {
                match = match && (pelicula.lanzamiento <= endDate);
            }

            return match;
        });

        renderPeliculas(filteredPeliculas);
    }

    function fetchProductoras() {
        $.get('/get/productoras', function (productoras) {
            let productoraSelect = $('#productora_id');
            productoraSelect.empty();
            productoras.forEach(productora => {
                productoraSelect.append(`<option value="${productora.id}">${productora.nombre}</option>`);
            });
        });
    }

    function fetchCategorias() {
        $.get('/get/categorias', function (categorias) {
            let categoriaSelect = $('#categoria_id');
            categoriaSelect.empty();
            categorias.forEach(categoria => {
                categoriaSelect.append(`<option value="${categoria.id}">${categoria.nombre}</option>`);
            });
        });
    }

    function editPelicula(id) {
        $.get(`/get/pelicula/${id}`, function (pelicula) {
            $('#pelicula_id').val(pelicula.id);
            $('#titulo').val(pelicula.titulo);
            $('#lanzamiento').val(pelicula.lanzamiento);
            $('#productora_id').val(pelicula.productora_id);
            $('#categoria_id').val(pelicula.categoria_id);
            $('#peliculaModal').modal('show');
        });
    }

    function deletePelicula(id) {
        $.ajax({
            url: `/delete/pelicula/${id}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'DELETE',
            success: function () {
                fetchPeliculas();
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function clearForm() {
        $('#pelicula_id').val('');
        $('#peliculaForm')[0].reset();
    }

    function sortTable(order) {
        fetchPeliculas(order);
    }

    async function playSong(id) {
        try {
            const response = await fetch(`/reproductor/play/${id}`);
            const song = await response.json();

            document.getElementById('song-title').innerText = song.titulo;
            document.getElementById('song-artist').innerText = song.productora.nombre;
            document.getElementById('song-image').src = song.categoria.portada;

            currentSongId = song.id;
        } catch (error) {
            console.error('Error fetching song:', error);
        }
    }
</script>
@endsection
