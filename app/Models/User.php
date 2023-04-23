<?php

namespace App\Models;
use App\Models\Cours;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasFactory;
    // use SoftDeletes;
   

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
    
    public function cours()
    {
        return $this->belongsToMany(Cours::class, 'cours_users', 'user_id', 'cours_id');
    }
    


     function enseignants()
{
    return $this->where('type', '=', 'enseignant')->get();
}


   

   
}
