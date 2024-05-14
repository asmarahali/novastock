<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BSortie;
use App\Models\BDecharge;
use App\Models\BCInterne;
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
   public function insertIntoBSortie($id_b_c_interne)
   { 
       $status = DB::table('b_c_internes')
                       ->where('id', $id_b_c_interne)
                       ->value('status');
                      
       $type = DB::table('b_c_internes')
                       ->where('id', $id_b_c_interne)
                       ->value('type');
                      
       if ($status == 3 and $type== 0 ) {
           DB::table('b_sorties')->insert([
               'date' => now(),
             
           ]);
           
       }else if($status == 3 and $type== 1) {
         DB::table('b_decharges')->insertUsing([
            'id', 'date', 'observation', 'Recovery'
        ], DB::table('b_c_internes')->select(
         'id', 'date', 'observation', 'Recovery'
        )    
         );
        
      }
   }
}
