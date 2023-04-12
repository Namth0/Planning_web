<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'cours';
    protected $fillable = ['intitule'];

    protected $hidden = ['created_at', 'updated_at'];

}
