<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'imagecour',
        'enseignant_id',
        'descriptionSuccincte',
        'nombreHeure',
        'coefDiplôme',
        'coefExamen',
        'coefTd',
       
    ];

    public function enseignant(){

        return $this->belongsTo(Enseignant::class, 'enseignant_id');
    }

    
}
