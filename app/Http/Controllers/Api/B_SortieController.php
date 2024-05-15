<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BSortie;
use App\Models\BDecharge;
use App\Models\BCInterne;
use App\Models\Quantite_Decharge;
use App\Models\quantite_sortie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class B_SortieController extends Controller
{
   public function index_b_sortie (){
    $bsortie = BSortie::all();
        return response()->json($bsortie, 200);
   }
   public function index_b_decharge (){
      $bdecharge = BDecharge::all();
      return response()->json($bdecharge, 200);
   }
   public function createBSorBD($id_b_c_interne)
   { 
      
       $status = DB::table('b_c_internes')
                       ->where('id', $id_b_c_interne)
                       ->value('status');
                      
       $type = DB::table('b_c_internes')
                       ->where('id', $id_b_c_interne)
                       ->value('type');
                      
       if ($status == 3 and $type== 0 ) {
         $bSortie = BSortie::create([
            'date' => now(), ]);
            DB::table('b_sortie_b_c_interne')->insert([
               'b_sortie_id' => $bSortie->id,
               'b_c_interne_id' => $id_b_c_interne,
           ]);
           $ListOfProducts = DB::table('quantite_demandes')
         ->where('b_c_interne_id', $id_b_c_interne)->get();
         foreach ($ListOfProducts as $product) {  
        $QS =  quantite_sortie::create([
        'product_id'=> $product->product_id,
        'b_sortie_id'=> $bSortie->id,
        'quantity'=>$product->quantity,
        ]);}
           
       }else if($status == 3 and $type== 1) {
         $bDecharge = BDecharge::create([
            'date' => now(),
            'observation'=>DB::table('b_c_internes')
            ->where('id', $id_b_c_interne)
            ->value('observation'),
             'Recovery'=>DB::table('b_c_internes')
             ->where('id', $id_b_c_interne)
             ->value('Recovery'),
          ]);
          $ListOfProducts = DB::table('quantite_demandes')
          ->where('b_c_interne_id', $id_b_c_interne)->get();

          foreach ($ListOfProducts as $product) {  
           
            $QS =  Quantite_Decharge::create([
            'product_id'=> $product->product_id,
            'b_decharge_id' => $bDecharge->id,
            'quantity'=>$product->quantity,
            ]);
         }
          DB::table('b_decharge_b_c_interne')->insert([
            'b_decharge_id' => $bDecharge->id,
            'b_c_interne_id' => $id_b_c_interne,
        ]);
      }
   }
}
