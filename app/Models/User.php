<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;
   

    public $timestamps = false;

    protected $hidden = ['mdp'];

    protected $fillable = ['nom','prenom','login', 'mdp', 'type'];

    protected $attributes = [
        'type' => 'user'
    ];


     public function getAuthPassword(){
        return $this->mdp;
    }

    public function isAdmin(){
         return $this->type == 'admin';
    }

   
}
