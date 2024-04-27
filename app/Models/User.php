<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class User extends Model
{  
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
     protected $fillable = [
        'firstname', 'lastname', 'email', 'numero', 'photo_url', 'is_active', 'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function scopeRSR($query)
    {
        return $query->where('role', 'RSR');
    }

    // this should not be here, 
    // ediha l user model 
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }


    /**
     * list permissions for this user
    */
    public function getPermissionsAttribute(){
        return $this->roles() // get me this user's roles
        ->with('permissions') // get permissions with each role
        ->get() // execute 
        ->pluck('permissions') // pluck only permissions attribute from all records
        ->flatten() // flatten results and get me only permissions collections
        ->unique(); // filter unique records (since many roles can share the same permission)
    }
}