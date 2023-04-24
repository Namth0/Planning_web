<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Formations extends Model
{
    use HasFactory;
    // use SoftDeletes;

    public $timestamps = false;
    protected $table = 'formations';

    protected $fillable = ['intitule'];
    protected $hidden = ['created_at', 'updated_at'];

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }
    
}
