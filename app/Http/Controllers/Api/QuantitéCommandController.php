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
    public function update(CreateQuantityCommandeRequest $request, $b_c_externe_id)
{

    foreach ($request->products as $product) {
        // Find the record with the specific b_c_externe_id and product_id
        $record = quantité_commande::where('b_c_externe_id', $b_c_externe_id)
            ->where('product_id', $product['product_id'])
            ->first();

        if ($record) {
            // Update the quantity of the found record
            $record->update(['quantity' => $product['quantity']]);
        } else {
            }
    }
        return response()->json([
            'status' => true,
            'message' => 'Quantities updated successfully for b_c_externe_id: ' . $b_c_externe_id,
        ], 200);
    }
    public function show( $b_c_externe_id){
       
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
