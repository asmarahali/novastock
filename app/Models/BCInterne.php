<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BCInterne extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'quantite_demandes')
        ->withPivot('quantity');
    }

    public function quantite_demandes(){
        return $this->hasMany(quantite_demande::class);

    }
}
