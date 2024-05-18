<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\B_Reception;
use App\Models\BCExterne;
use App\Models\Quantite_livre;
use Illuminate\Support\Facades\DB;
class B_ReceptionController extends Controller
{
    public function index()
    {
       
        $breception = B_Reception::all();
        return response()->json($breception, 200);
    } 
    
    public function store(Request $request, $id_b_c_externe)
    {
        // Check if the b_c_externe_id exists in the b_c_externe table
        if (!BCExterne::where('id', $id_b_c_externe)->exists()) {
            return response()->json(['message' => 'Invalid b_c_externe_id'], 400);
        }
    
        $validatedData = $request->validate([
            'date' => 'required|date',
        ]);
    
        // Create the B_Reception record
        $bReception = B_Reception::create([
            'date' => $validatedData['date'],
            'b_c_externe_id' => $id_b_c_externe,
        ]);
        $ListOfProducts = DB::table('quantite_commandes')
        ->where('b_c_externe_id', $id_b_c_externe)->get();
        foreach ($ListOfProducts as $product) {  
            $QS =  Quantite_livre::create([
            'product_id'=> $product->product_id,
            'b_reception_id'=> $bReception->id,
            'quantity'=> 0,
            ]);
        } if ($bReception) {
            return response()->json(['message' => 'B_Reception created successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to create B_Reception'], 500);
        }
  }
}