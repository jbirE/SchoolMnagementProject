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
    Schema::create('cours', function (Blueprint $table) {
        $table->id();
        $table->integer('code')->unique();
        $table->string('imagecour');
        $table->text('descriptionSuccincte');
        $table->time('nombreHeure');
        $table->integer('coefDiplôme');
        $table->integer('coefExamen');
        $table->integer('coefTd');
        $table->unsignedBigInteger('enseignant_id'); // Change the column name
        $table->foreign('enseignant_id')->references('id')->on('enseignants')->onDelete('restrict');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
