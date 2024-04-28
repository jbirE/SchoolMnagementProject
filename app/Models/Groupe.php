<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_groupe',
    ];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class, 'groupe_id');
    }
}
