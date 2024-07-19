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

    .search-container, .add-container {
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
    }

    .search-container input, .add-container input {
        width: 300px;
        margin-right: 5px;
    }

    .search-container button, .add-container button {
        display: inline-flex;
        align-items: center;
    }
</style>
@endsection

@section('title', 'Categorias')

@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}">
<h1 class="h2 text-center">ALBUMES</h1>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<div class="search-container">
    <input type="text" id="search-input" class="form-control" placeholder="Buscar por nombre...">
    <button id="search-btn" class="btn btn-secondary">
        <i class="bi bi-search"></i>
    </button>
</div>

<div class="add-container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoriaModal" onclick="clearForm()">
        Añadir Album
    </button>
</div>

<table class="table table-sm table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Id</th>
            <th>Portada</th>
            <th>Nombre</th>
            <th>Fecha de Lanzamiento</th>
            <th>Editar/Eliminar</th>
        </tr>
    </thead>
    <tbody id="categoriasTableBody">
        
    </tbody>
</table>

<div class="modal fade" id="categoriaModal" tabindex="-1" aria-labelledby="categoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="categoriaForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="categoriaModalLabel">Añadir/Editar Album</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="categoria_id" name="id">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="portada">Portada</label>
                        <input type="text" class="form-control" name="portada" id="portada" value="{{ old('portada', $album->portada ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="lanzamiento">Lanzamiento</label>
                        <input type="date" class="form-control" id="lanzamiento" name="lanzamiento" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        fetchCategorias();

        $('#categoriaForm').on('submit', function (e) {
            e.preventDefault();
            let id = $('#categoria_id').val();
            let url = id ? `/update/categoria/${id}` : '/insert/categoria';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: $('#categoriaForm').serialize(),
                success: function (response) {
                    $('#categoriaModal').modal('hide');
                    fetchCategorias();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });

        $('#search-btn').on('click', function () {
            applyFiltersCat();
        });
    });

    function fetchCategorias() {
        $.get('/get/categorias', function (data) {
            categorias = data; 
            renderCategorias(categorias); 
        });
    }

    function renderCategorias(data) {
        let tableBody = $('#categoriasTableBody');
        tableBody.empty();
        data.forEach(categoria => {
            tableBody.append(`
                <tr>
                    <td>${categoria.id}</td>
                    <td><img src="${categoria.portada}" alt="${categoria.nombre}" width="50"></td>
                    <td>${categoria.nombre}</td>
                    <td>${categoria.lanzamiento}</td>
                    <td>
                        <button class="btn btn-warning" onclick="editCategoria(${categoria.categoria_id})"><i class="bi bi-pencil-fill"></i></button>
                        <button class="btn btn-danger" onclick="deleteCategoria(${categoria.categoria_id})"><i class="bi bi-backspace-fill"></i></button>
                    </td>
                </tr>
            `);
        });
    }

    function applyFiltersCat() {
        let searchValue = $('#search-input').val().toLowerCase();

        let filteredCategorias = categorias.filter(function (categoria) {
            let match = true;

            if (searchValue) {
                match = categoria.nombre.toLowerCase().includes(searchValue);
            }

            return match;
        });

        renderCategorias(filteredCategorias);
    }

    function editCategoria(categoria_id) {
        $.get(`/get/categoria/${id}`, function (categoria) {
            $('#categoria_id').val(categoria.categoria_id);
            $('#portada').val(categoria.portada);
            $('#nombre').val(categoria.nombre);
            $('#lanzamiento').val(categoria.lanzamiento);
            $('#categoriaModal').modal('show');
        });
    }

    function deleteCategoria(id) {
        $.ajax({
            url: `/delete/categoria/${id}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'DELETE',
            success: function () {
                fetchCategorias();
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function clearForm() {
        $('#categoria_id').val('');
        $('#categoriaForm')[0].reset();
    }
</script>
@endsection
