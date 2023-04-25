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
    // Vérifier s'il y a un planning associé au cours
    if ($this->planning) {
        // Extraire la semaine à partir de la date de début du planning
        $dateDebut = $this->planning->date_debut;
        $semaine = $dateDebut->isoWeek();
        
        // Retourner le numéro de la semaine
        return $semaine;
    }
    
    // Retourner une valeur par défaut si aucun planning n'est associé
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
