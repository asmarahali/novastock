<?php

namespace App\Http\Requests;
use App\Http\Requests\BaseApiRequest;

// a3tiha more meaninghful name, such as CreateQuantityCommande wla haja haka
// QuantitéCommandeRequest can stand for update/create/delete requests
// bdliha 
//   besa7 khsni thani n gerer genre n9der n delete produit wla nbdal quantité 3liha bghit n5lih hak 
// nkhalih wla nbdlo ? de prefenerce tbdliha, it should tell what it does mn ismo okay 
// PS: tb3ti naming convention whda, english wla french, idha kan tse3dk french renam okay 9olt nkml ymchi code wnbdal kolch  
// okey, refactoring in Green is always a good idea :)
class CreateQuantityCommandeRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // exists:table_name,column_name
            // bsah, why ids? rah tb3thi bzef? 9olt produit y9der ykon fi plueseur(telftli kifah nktebha XD) bc yak 9otli madam many to many zidi s 
            'b_c_externe_id' => 'required|exists:b_c_externes,id', // hadhya mliha 
            // no, ma9sdtch haka, doka since we're creating bc wahd w rah najoutiwlo many products, 
            // it does not make sense bch nb3tho many bcs 
            // yeah mm ana m3a lwl khamamt hok wthani khammt nb3th produit wa7ed brk 3liha derthom fi zouj wa7d wa7ed fhamtni ? 
            // wait

            'products' => 'array', // this needs to be array (of objects) sah

            // php will serialize them into multi-dimensional array
            // since there's no object data type in PHP
            // sama each item of the products array must be also an array
            // okey? okay
            'products.*' => 'array',

            // doka each array must have two keys, product_id and quantity
            // okeu? okay 
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1'

            // each product_id must be a real record yak? ih 
            // w each quantity must be integer yak? ih kifah nzid at least tkon 1 
            // haka we're done with validation proccess

            // lik lvalidation rules wch rah yghatiw: 
            /**
             * lvaleur ta3hda should be an array (array)
             * each value should be a real record (exists:products,id)
            */

            // the problem ay hna
            //'product_ids' => 'required|exists:product,id',
            //'quantity' => 'required|integer|min:1',
        ];
    }
}
