<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\chapter;

class ChapterController extends Controller
{
     public function index()
    {
        $chapters = Chapter::all();
        return response()->json($chapters, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $chapter = Chapter::create($request->all());

        return response()->json($chapter, 201);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:chapters,id',
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $chapter = Chapter::findOrFail($request->id);
        $chapter->update($request->all());

        return response()->json($chapter, 200);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:chapters,id',
        ]);

        $chapter = Chapter::findOrFail($request->id);
        $chapter->delete();

        return response()->json([], 204);
    }
}
