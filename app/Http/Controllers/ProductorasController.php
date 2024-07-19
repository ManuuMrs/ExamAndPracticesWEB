<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productora;

class ProductorasController extends Controller
{
    public function view(){
        return view('cruds.productoras');
    }

    public function index()
    {
        return response()->json(Productora::all(), 200);
    }

    public function show($id)
    {
        return response()->json(Productora::find($id), 200);
    }

    public function store(Request $request)
    {
        $productora = Productora::create($request->all());
        return response()->json($productora, 201);
    }

    public function update(Request $request, $id)
    {
        $productora = Productora::findOrFail($id);
        $productora->update($request->all());
        return response()->json($productora, 200);
    }

    public function destroy($id)
    {
        Productora::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}