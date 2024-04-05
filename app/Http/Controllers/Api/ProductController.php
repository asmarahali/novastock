<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json(['products' => $products], 200);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'min' => 'required|integer',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'article_id' => 'nullable|exists:articles,id'
        ]);

        $product = Product::create($request->all());
        return response()->json(['product' => $product], 201);
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['product' => $product], 200);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'string',
            'description' => 'nullable|string',
            'quantity' => 'integer',
            'price' => 'numeric',
            'min' => 'integer',
            'fournisseur_id' => 'exists:fournisseurs,id',
            'article_id' => 'nullable|exists:articles,id'
        ]);

        $product->update($request->all());
        return response()->json(['product' => $product], 200);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}

