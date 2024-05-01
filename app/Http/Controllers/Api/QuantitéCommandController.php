<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateQuantityCommandeRequest;
use App\Models\quantité_commande;

class QuantitéCommandController extends Controller
{
    public function store(CreateQuantityCommandeRequest $request)
    {
        $data = array_map(function($product) use($request) {
            return array_merge($request->only('b_c_externe_id'), $product);
        }, $request->products); 
        quantité_commande::insert($data);
        //foreach ($request->products as $product) {
        //    $data = array_merge($product, $request->only('b_c_externe_id'));
        //    $QC = quantité_commande::create($data); // one per each round
        // }
        return response()->json([
            'status' => true,
            'message' => 'registered commanded quantity for each product for the current bon de command successfully.',

        ], 200);
    }

    public function show( $b_c_externe_id){
        dd("hello");
        $quantities = quantité_commande::where('b_c_externe_id', $b_c_externe_id)->get();

        // Check if quantities exist
        if ($quantities->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No quantities found for the provided id_bce.'
            ], 404);
        }
    
        return response()->json([
            'status' => true,
            'quantities' => $quantities
        ], 200);
    }
}
