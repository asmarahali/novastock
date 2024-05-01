<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B_livraison extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'quantite_livre')
                    ->withPivot('quantity');
    }

    /**
     * return the delivred quantites for this 
     * bon de livraison
     * @return HasMany
    */
   
    public function quantites_livres(){
        return $this->hasMany(Quantite_livre::class);
    }

    /**
     * get the related bon de commande externe
     * associated with this bon de livraison
    */
    public function b_c_externe(){
        return $this->belongsTo(BCExterne::class, 'b_c_externe_id');
    }
}
