<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BCInterne;
class B_C_InterneController extends Controller
{
    public function index()
    {
        $bcExternes = BCInterne::all();
        return response()->json($bcExternes, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            
        ]);

        $BCE = BCInterne::create($request->all());

        return response()->json($BCE, 201);
    }
    public function show($id)
    {
        $bcExterne = BCInterne::findOrFail($id);
        return response()->json($bcExterne, 200);
    }
    public function destroy($id)
    {
        $bcExterne = BCInterne::findOrFail($id);
        $bcExterne->delete();

        return response()->json(null, 204);
    }

}
