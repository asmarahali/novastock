<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'adresse',
        'number',
        'email',
        'bio',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
