<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'min',
        'fournisseur_id',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }


    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
