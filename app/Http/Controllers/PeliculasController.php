<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;

class PeliculasController extends Controller
{
    public function view(){
        return view('cruds.peliculas');
    }

    public function getPeliculas(Request $request)
    {
        $order = $request->query('order', 'asc'); 
        $peliculas = Pelicula::with(['productora', 'categoria'])->orderBy('id', $order)->get();
        return response()->json($peliculas);
    }

    public function index()
    {
        return response()->json(Pelicula::all(), 200);
    }

    public function show($id)
    {
        return response()->json(Pelicula::find($id), 200);
    }

    public function store(Request $request)
    {
        $pelicula = Pelicula::create($request->all());
        return response()->json($pelicula, 201);
    }

    public function update(Request $request, $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->update($request->all());
        return response()->json($pelicula, 200);
    }

    public function destroy($id)
    {
        Pelicula::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
