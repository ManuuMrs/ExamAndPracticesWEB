@extends('layouts.welcome')

@section('content')
    <div class="container">
        <h1>Reproductor de Canciones</h1>

        <form action="{{ route('ListRepro.listrepro') }}" method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <label for="pelicula_id">Buscar por ID:</label>
            <input type="text" id="pelicula_id" name="pelicula_id" class="form-control" value="{{ request('pelicula_id') }}">
        </div>
                <div class="col-md-3">
                    <label for="orderBy">Ordenar por:</label>
                    <select name="orderBy" id="orderBy" class="form-control">
                        <option value="pelicula_id" {{ request('orderBy') == 'pelicula_id' ? 'selected' : '' }}>ID</option>
                        <option value="nombre" {{ request('orderBy') == 'nombre' ? 'selected' : '' }}>Nombre Canción</option>
                        <!-- <option value="artista.nombre" {{ request('orderBy') == 'artista.nombre' ? 'selected' : '' }}>Nombre Artista</option> -->
                        <option value="duracion" {{ request('orderBy') == 'duracion' ? 'selected' : '' }}>Duración</option>
                        <!-- <option value="album.nombre" {{ request('orderBy') == 'album.nombre' ? 'selected' : '' }}>Nombre Álbum</option> -->
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="order">Orden:</label>
                    <select name="order" id="order" class="form-control">
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descendente</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>&nbsp;</label><br>
                    <button type="submit" class="btn btn-primary">Aplicar filtros</button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Canción</th>
                    <th>Nombre Artista</th>
                    <th>Duración</th>
                    <th>Nombre Álbum</th>
                    <th>Portada</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peliculas as $pelicula)
                    <tr>
                        <td> ${pelicula.pelicula_id }</td>
                        <td> ${pelicula.nombre }</td>
                        <td> ${pelicula.artista->nombre }</td>
                        <td> ${pelicula.duracion }</td>
                        <td> ${pelicula.categoria.nombre }</td>
                        <td><img src=" ${pelicula.categoria.portada}" alt=" ${pelicula.categoria.nombre}" width="50"></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No se encontraron canciones.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
