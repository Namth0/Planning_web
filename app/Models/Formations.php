<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formations extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'formations';

    protected $fillable = ['intitule'];
    protected $hidden = ['created_at', 'updated_at'];
    
}
