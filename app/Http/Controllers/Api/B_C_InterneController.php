<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BCInterne;
use App\Models\quantite_demande;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class B_C_InterneController extends Controller
{
    public function index()
    {
        $bcExternes = BCInterne::all();
        return response()->json($bcExternes, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'type' => 'required',
            'observation',
        ]);

        $BCE = BCInterne::create($request->all());

        return response()->json($BCE, 201);
    }
    public function show($id)
    {
        $bcInterne = BCInterne::findOrFail($id);
        return response()->json($bcInterne, 200);
    }
    public function destroy($id)
    {
        $bcInterne = BCInterne::findOrFail($id);
        $bcInterne->delete();

        return response()->json(null, 204);
    }

    public function ChangeStatus(){
        
      // hadhi ? ih .. hedhia zaama tbdl status ta3 bci. gtlk khaliha tkon fe la logique ta3 update bci 
      // example: min yconfirmi lcons bci rah ttbdl status // hna 9asdek ydir envoyer puisque confermer y tsauvgarder brk . ih 
      // bsah it should not be accessed this way. imagini ja consomateur w b3th 3 requests at the same time 
      // status rah tkon directment 3 bla ma chafha ta wahd. fhmti lproblem fiha? ih fhamtek mais kayna 7aja + kima ydir envyer syy ma9derch
      // yzid ydir envoyer yro7lo le droit .. iih justement
      // hadhya lmethod ChangeStatus rah tkhdm b7sab l'etat ta3 bci +++ role ta3 luser

      // ex: status 0 + consomateur
      // kima y'acessi had route systematiquement rah ttbdl mn 0 l 1 
      // w ida accessisah wekhdokhr tjih not allowed, psq fhad lmar7la lconsomateur whdo li y9dr y'envoye a l'etape suivante
      // fhmti? ih fhamtek 
        
          
    }

    public function send(BCInterne $bc){
        
        $currentStatus = $bc->getStatus(); 
        abort_if($currentStatus == 'envoye', 401); 

        if($currentStatus == 'pret' && $bc->status != 'sent_from_dir_to_mag'){
            $statuses = (new BCInterne)->statusRepresentation;
            $statuses = array_flip($statuses);
            $statusCode = $statuses[$bc->status];
            $bc->status = (int) $statusCode + 1;
            $bc->save();
        }

        return response()->json([
            'message' => 'Sent succussefully to the next step!'
        ]);
    }

   public function countBci(){
     $bci = BCInterne::where('status', 3)->count();
     dd($bci);
     return $bci;
   }
   public function countBS(){
    $bci = BCInterne::where('status', 3)->where('type', 0)->count();
    dd($bci);
    return $bci;
  }
  public function countBD(){
    $bci = BCInterne::where('status', 3)->where('type', 1)->count();
    dd($bci);
    return $bci;
  }
    //public function index_b_sortie (){
      //  $bsorties = BCInterne::bSortie()->get();
        //    return response()->json($bsorties, 200);
       //}
     //  public function index_b_decharge(){
       // $bsortie = BCInterne::where('type', false)->where('status', 3)->get();
         //   return response()->json($bsortie, 200);
       //}
       public function getUserBCICount($id)
    {
        $bciCount = BCInterne::where('user_id', $id)->count();

        if (!$bciCount) {
            return response()->json(['message' => 'User not found or no BCIs associated with this user'], 404);
        }

        return response()->json([
            'bci_count' => $bciCount,
        ]);
    }
    public function getConsumptionStatistics(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'month' => 'required|integer|between:1,12'
        ]);
    
        $userId = $request->input('user_id');
        $productId = $request->input('product_id');
        $month = $request->input('month');
        $year = Carbon::now()->year;
    
        $bciIds = DB::table('b_c_internes')
            ->where('user_id', $userId)
            ->pluck('id');
      
            if ($bciIds->isEmpty()) {
              return response()->json([
                  ['week' => 1, 'total_quantity' => 0],
                  ['week' => 2, 'total_quantity' => 0],
                  ['week' => 3, 'total_quantity' => 0],
                  ['week' => 4, 'total_quantity' => 0]
              ]);
          }
    
       /* $statistics = quantite_demande::whereIn('b_c_interne_id', $bciIds)
            ->where('product_id', $productId)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->selectRaw('WEEK(created_at) as week, SUM(quantity) as total_quantity')
            ->groupBy('week')
            ->get();
    */
    $statistics = quantite_demande::whereIn('b_c_interne_id', $bciIds)
    ->where('product_id', $productId)
    ->whereMonth('created_at', $month)
    ->whereYear('created_at', $year)
    ->selectRaw('WEEK(created_at, 1) - WEEK(DATE_SUB(created_at, INTERVAL DAYOFMONTH(created_at)-1 DAY), 1) + 1 as week, SUM(quantity) as total_quantity')
    ->groupBy('week')
    ->get()
    ->keyBy('week'); 
$result = [
    ['week' => 1, 'total_quantity' => 0],
    ['week' => 2, 'total_quantity' => 0],
    ['week' => 3, 'total_quantity' => 0],
    ['week' => 4, 'total_quantity' => 0]
];

foreach ($result as &$weekData) {
    if (isset($statistics[$weekData['week']])) {
        $weekData['total_quantity'] = $statistics[$weekData['week']]->total_quantity;
    }
}
return response()->json($result);
} 
}
