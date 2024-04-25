<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'quantity', 'price', 'min'
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }


    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}