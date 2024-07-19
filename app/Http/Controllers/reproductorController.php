<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;

class ReproductorController extends Controller
{
    public function index()
    {
        return view('cruds.peliculas');
    }

    public function random()
    {
        $pelicula = Pelicula::inRandomOrder()->with('categoria', 'productora')->first();
        return response()->json($pelicula);
    }

    public function next($id)
    {
        $pelicula = Pelicula::where('id', '>', $id)->with('categoria', 'productora')->orderBy('id')->first();
        if (!$pelicula) {
            $pelicula = Pelicula::orderBy('id')->with('categoria', 'productora')->first();
        }
        return response()->json($pelicula);
    }

    public function previous($id)
    {
        $pelicula = Pelicula::where('id', '<', $id)->with('categoria', 'productora')->orderBy('id', 'desc')->first();
        if (!$pelicula) {
            $pelicula = Pelicula::orderBy('id', 'desc')->with('categoria', 'productora')->first();
        }
        return response()->json($pelicula);
    }

    public function play($id)
    {
        $pelicula = Pelicula::with('categoria', 'productora')->findOrFail($id);
        return response()->json($pelicula);
    }
}
