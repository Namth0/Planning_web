<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class CoursUser extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'cours_users';
    protected $fillable = ['cours_id', 'user_id'];

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

