<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'cours';
    protected $fillable = ['intitule','user_id','formation_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    public function enseignant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function etudiants()
    {
        return $this->belongsToMany(User::class, 'cours_users', 'cours_id', 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'cours_users');
    }

    

}
