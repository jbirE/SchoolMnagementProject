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
    Schema::create('enseignants', function (Blueprint $table) {
        $table->id();
        $table->integer('code')->unique();
        $table->string('imageens');
        $table->string('nom');
        $table->string('prénom');
        $table->string('grade');
        $table->integer('téléphone');
        $table->string('mail');
        $table->integer('numBureau');
        $table->string('login');
        $table->string('password');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignants');
    }
};
