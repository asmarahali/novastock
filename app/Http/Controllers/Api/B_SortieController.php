<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BSortie;
use Illuminate\Http\Request;

class B_SortieController extends Controller
{
   public function index_b_sortie (){
    $bsortie = BSortie::all();
        return response()->json($bsortie, 200);
   }
}
