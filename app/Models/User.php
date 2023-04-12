<?php

namespace App\Models;
use App\Models\Cours;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;
   

    public $timestamps = false;

    protected $hidden = ['mdp'];

    protected $fillable = ['nom','prenom','login', 'mdp','formation_id', 'type'];

    protected $attributes = [
        'type' => null
    ];


     public function getAuthPassword(){
        return $this->mdp;
    }

    public function IsAdmin(){
         return $this->type == 'admin';
    }
    
    function cours(){
        return $this->belongsToMany(Cours::class);
    }

     function enseignants()
{
    return $this->where('type', '=', 'enseignant')->get();
}


   

   
}
