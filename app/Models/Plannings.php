<?php

namespace App\Models;
use App\Models\Cours;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plannings extends Model
{
    use HasFactory;
    protected $table = 'plannings';

    protected $fillable = [
        'cours_id',
        'date_debut',
        'date_fin',
    ];

    public $timestamps = false;

    public function cours()
    {
        return $this->belongsTo('App\Models\Cours');
    }

    public function enseignants()
    {
        return $this->belongsToMany(User::class, 'cours_users', 'cours_id', 'user_id')
            ->where('type', 'enseignant');
    }

}
