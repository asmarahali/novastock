<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\quantite_sortie;
use Illuminate\Http\Request;

class QuantiteSortieController extends Controller
{
    public function show( $b_sortie_id){
       
        $quantities = quantite_sortie::where('b_sortie_id', $b_sortie_id)->get();
       // dd($quantities);
        // Check if quantities exist
        if ($quantities->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No quantities found for the provided id_BS.'
            ], 404);
        }
        
        return response()->json([
            'status' => true,
            'quantities' => $quantities
        ], 200);
    }
}
