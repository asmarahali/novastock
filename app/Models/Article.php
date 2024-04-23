<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'chapiter_id',
        'label',
        'description',
    ];
    public function chapiter()
{
    return $this->belongsTo(Chapiter::class);
}

public function products()
{
    return $this->belongsToMany(Product::class);
}
}
