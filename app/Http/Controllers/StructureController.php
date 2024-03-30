<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    public function index()
    {
        return Structure::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Libelle' => 'required|unique:structures|string',
            'Résponsable' => 'required|string',
        ]);

        return Structure::create($request->all());
    }

    public function show($id)
    {
        return Structure::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $structure = Structure::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'Libelle' => 'required|unique:structures|string',
            'Résponsable' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            dd($validator->errors());
        }
        
        $structure->update($request->all());
        return $structure;
    }

    public function destroy($id)
    {
        $structure = Structure::findOrFail($id);
        $structure->delete();
        return 204;
    }
}
