<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_etudiant',
        'imageetud',
        'Nom',
        'Prenom',
        'DateNaissance',
        'groupe_id',
        'diplome_id',
        'adressePersonnelle',
        'mail',
        'téléphone',
        'login',
        'password',
    ];

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupe_id');
    }

    public function diplome()
    {
        return $this->belongsTo(Diplome::class, 'diplome_id');
    }
}
