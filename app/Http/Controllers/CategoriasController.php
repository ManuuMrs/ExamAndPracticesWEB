<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriasController extends Controller
{
    public function view(){
        return view('cruds.categorias');
    }

    public function index()
    {
        return response()->json(Categoria::all(), 200);
    }

    public function show($id)
    {
        return response()->json(Categoria::find($id), 200);
    }

    public function store(Request $request)
    {
        $categoria = Categoria::create($request->all());
        return response()->json($categoria, 201);
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());
        return response()->json($categoria, 200);
    }

    public function destroy($id)
    {
        Categoria::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}