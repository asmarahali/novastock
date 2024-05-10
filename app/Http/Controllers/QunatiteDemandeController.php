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
}
