<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BCInterne extends Model
{
    public $statusRepresentation = [
        0 => 'not_sent_from_con', // pret for con
        1 => 'sent_from_con_to_res', // envoye for con, pret for res
        2 => 'sent_from_res_to_dir', // envoye for res, pret for dir
        3 => 'sent_from_dir_to_mag', // envoye for dir, pret for mag
    ];
    protected $statusesPerRole = [
        'magazinier' => [
            'sent_from_dir_to_mag' => 'pret'
        ],
        'directeur' => [
            'sent_from_res_to_dir' => 'pret',
            'sent_from_dir_to_mag' => 'envoye'
        ],
        'responsable' => [
            'sent_from_con_to_res' => 'pret',
            'sent_from_res_to_dir' => 'envoye'
        ],
        'consomateur' => [
            'not_sent_from_con' => 'pret',
            'sent_from_con_to_res' => 'envoye'
        ]
    ];

    use HasFactory;
    protected $fillable = [
        'date',
        'status',
         'type',
    ];
    protected $casts = [
        'type' => 'boolean',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'quantite_demandes')
        ->withPivot('quantity');
    }
    public function quantite_demandes(){
        return $this->hasMany(quantite_demande::class);
    }
    /**
     * define new accessor that returns 
     * the string represention for the status string
     * @return string
    */
    public function getStatusAttribute($value){
        return $this->statusRepresentation[$value];
    }
    
   
    public function getStatus(){
        // $role = auth()->user()->role; // temp
        // $roleName = $role->name;
        $roleName = 'directeur';

        return array_key_exists($this->status, $this->statusesPerRole[$roleName])
        ? $this->statusesPerRole[$roleName][$this->status]
        : 'not_accesible';
    }

}
