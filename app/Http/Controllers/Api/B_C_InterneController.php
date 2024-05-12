<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BCInterne;
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
         
        ]);

        $BCE = BCInterne::create($request->all());

        return response()->json($BCE, 201);
    }
    public function show($id)
    {
        $bcExterne = BCInterne::findOrFail($id);
        return response()->json($bcExterne, 200);
    }
    public function destroy($id)
    {
        $bcExterne = BCInterne::findOrFail($id);
        $bcExterne->delete();

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


}
