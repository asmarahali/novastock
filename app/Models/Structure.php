<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{ 
     use HasFactory;
    protected $fillable = [
        'Libelle', 
        'Résponsable'
    ];
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }
}
