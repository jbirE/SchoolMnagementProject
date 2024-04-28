<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Enseignant extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'imageens',
        'nom',
        'prénom',
        'grade',
        'téléphone',
        'mail',
        'numBureau',
        'login',
        'password'
    ];

   
   
}

