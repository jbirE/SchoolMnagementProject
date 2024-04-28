<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->integer('id_etudiant')->unique();
            $table->string('imageetud');
            $table->string('Nom');
            $table->string('Prenom');
            $table->date('DateNaissance')->nullable();
            $table->unsignedBigInteger('groupe_id');
            $table->unsignedBigInteger('diplome_id');
            $table->string('adressePersonnelle');
            $table->string('mail');
            $table->integer('téléphone');
            $table->string('login');
            $table->string('password');
            $table->timestamps();
    
            $table->foreign('groupe_id')->references('id')->on('groupes')->onDelete('restrict');
            $table->foreign('diplome_id')->references('id')->on('diplomes')->onDelete('restrict');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
