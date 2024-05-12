<?php

namespace App\Http\Controllers;

use App\Models\quantite_demande;
use App\Http\Requests\CreateQunatitiesDemandeRequest;

class QunatiteDemandeController extends Controller
{
    public function store(CreateQunatitiesDemandeRequest $request)
    {
        $data = array_map(function($product) use($request) {
            return array_merge($request->only('b_c_interne_id'), $product);
        }, $request->products); 
        quantite_demande::insert($data);
        return response()->json([
            'status' => true,
            'message' => 'registered requested quantity for each product for the current bon de command successfully.',

        ], 200);
    }

   
    public function update(CreateQunatitiesDemandeRequest $request, $b_c_interne_id){

        foreach ($request->products as $product) {
            // Find the record with the specific b_c_externe_id and product_id
            $record = quantite_demande::where('b_c_interne_id', $b_c_interne_id)
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
                'message' => 'Quantities updated successfully for b_c_interne_id: ' . $b_c_interne_id,
            ], 200);
        }
}
