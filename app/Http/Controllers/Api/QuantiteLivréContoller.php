<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\B_livraison;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Quantite_livre;
use App\Rules\ProductExistsInBL;
use App\Rules\CheckProductCommande;

class QuantiteLivréContoller extends Controller
{
    /**
     * register a new delivred quantity for the given 
     * b_livrasion 
     * 
     * @param Request $request
     * @param B_livraion $b_livraison
    */
    public function store (Request $request, B_livraison $b_livraison){
        
        $data = $request->validate([
            '*.product_id' => [
                'required',
                'exists:products,id',
                new ProductExistsInBL($b_livraison->id)
            ],
            '*.quantity' => [
                'required',
                'integer',
                new CheckProductCommande($b_livraison->id)
            ]
        ]);

        // solution 1
        foreach ($data as $p) {          
            $exists = Quantite_livre::where('product_id', $p['product_id'])
            ->where('b_livraison_id', $b_livraison->id)
            ->exists();

            if($exists){
               $ql = Quantite_livre::where('product_id', $p['product_id'])
               ->where('b_livraison_id', $b_livraison->id)
               ->first();

               $ql->update(['quantity' => (int) $p['quantity'] + $ql->quantity]);
        }else{
            Quantite_livre::create(
                [
                    'product_id' => $p['product_id'],
                    'b_livraison_id' => $b_livraison->id,
                    'quantity' => $p['quantity']
                ]
            );
        }
        }

        // $b_livraison->quantites_livres()->create($data);

        // solution 2 - diri whda fihom 
        /*
        $data = array_merge($data, ['b_livraison_id' => $b_livraison->id]);
        $ql = Quantite_livre::create($data); */

        // extracting the product_id values from each array
        $products_ids = array_map(function($v){
            return $v['product_id'];
        }, $data);

        // retrieving all the products with the given ids
        $products = Product::find($products_ids);

        // mapping through the products collection
        $products = $products->map(function($product) use($b_livraison){

            // creating a new attribute new_quantity and associate a value to it: 
            $product->new_quantity = $product->getDelivredQuantityForBLivraison($b_livraison->id);

            // overriding its value
            return $product;
        });

        return response()->json([

            // returnig only new_quantities + id attributes
            'new_quantities' => $products->pluck('new_quantity', 'id')
        ], 200);
    }
}
