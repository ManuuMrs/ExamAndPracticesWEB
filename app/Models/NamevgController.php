<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Namevg;

class NamevgController extends Controller
{
    public function index()
    {
        $namevgs = Namevg::all();
        return view('namevgs.index', compact('namevgs'));
    }

    public function create()
    {
        return view('namevgs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'producer' => 'required|unique:namevg',
            'owner' => 'required|unique:namevg',
            'releasedata' => 'nullable|date',
            'digital' => 'required|boolean',
            'weight' => 'required',
        ]);

        Namevg::create($request->all());

        return redirect()->route('namevgs.index')
                         ->with('success', 'Record created successfully.');
    }

    public function edit(Namevg $namevg)
    {
        return view('namevgs.edit', compact('namevg'));
    }

    public function update(Request $request, Namevg $namevg)
    {
        $request->validate([
            'name' => 'required',
            'producer' => 'required|unique:namevg,producer,' . $namevg->id,
            'owner' => 'required|unique:namevg,owner,' . $namevg->id,
            'releasedata' => 'nullable|date',
            'digital' => 'required|boolean',
            'weight' => 'required',
        ]);

        $namevg->update($request->all());

        return redirect()->route('namevgs.index')
                         ->with('success', 'Record updated successfully.');
    }

    public function destroy(Namevg $namevg)
    {
        $namevg->delete();

        return redirect()->route('namevgs.index')
                         ->with('success', 'Record deleted successfully.');
    }
}
