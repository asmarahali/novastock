<?php

namespace App\Http\Controllers\Api;
use App\Models\Structure;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    public function index()
    {
        $structures = Structure::all();
        return response()->json($structures);
    }
   
    public function show( $structure_id)
{
    $structure = Structure::with('responsible')->find($structure_id);

    if (!$structure) {
        return response()->json([
            "status" => false,
            "message" => "Structure not found."
        ], 404);
    }

    $structureName = $structure->name;

    $responsibleFirstName = $structure->responsible->firstname;
    $responsibleLastName = $structure->responsible->lastname;

    return response()->json([
        "status" => true,
        "structure_name" => $structureName,
        "responsible_firstname" => $responsibleFirstName .' '.$responsibleLastName,
       
    ]);
}
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'responsible_id' => 'required|exists:users,id',
        ]);

        $responsible = User::responsibles()->findOrFail($request->responsible_id);

        $unit = Structure::create([
            'name' => $request->name,
            'responsible_id' => $responsible->id,
        ]);

        return response()->json($unit, 201);
    }

    public function update(Request $request, Structure $unit)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'responsible_id' => 'sometimes|required|exists:users,id',
        ]);

        if ($request->has('responsible_id')) {
            $responsible = User::responsibles()->findOrFail($request->responsible_id);
            $unit->responsible_id = $responsible->id;
        }

        if ($request->has('name')) {
            $unit->name = $request->name;
        }

        $unit->save();
        return response()->json($unit, 200);
    }
    // Remove the specified resource from storage
    public function destroy(Structure $structure)
    {
        $structure->delete();
        return response()->json(null, 204);
    }
    
}
