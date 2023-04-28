<?php

namespace App\Models;
use App\Models\User;
use App\Models\Formations;
use App\Models\Plannings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Cours extends Model
{
    use HasFactory;
    // use SoftDeletes;

    public $timestamps = false;

    protected $table = 'cours';
    protected $fillable = ['intitule','user_id','formation_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function formation()
    {
        return $this->belongsTo(Formations::class, 'formation_id');
    }

    public function enseignants()
    {
        return $this->belongsToMany(User::class, 'cours_users', 'cours_id', 'user_id');
    }

    public function plannings()
{
    return $this->hasMany(Plannings::class);
}

    public function planning()
    {
        return $this->hasOne(Plannings::class);
    }



public function semaine()
{

    if ($this->planning) {
        $dateDebut = $this->planning->date_debut;
        $semaine = $dateDebut->isoWeek();
        return $semaine;
    }
    return "N/A";
}


    public function etudiants()
    {
        return $this->belongsToMany(User::class, 'cours_users', 'cours_id', 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'cours_users', 'cours_id', 'user_id');
    }
    

    

}
