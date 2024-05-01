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
}
