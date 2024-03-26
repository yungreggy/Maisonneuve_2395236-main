<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('contenu');
            $table->dateTime('date_publication');
            $table->unsignedBigInteger('etudiant_id'); // Clé étrangère vers la table des étudiants
            $table->string('langue', 2)->default('fr'); // 'fr' pour français, 'en' pour anglais
            $table->foreign('etudiant_id')->references('id')->on('etudiants')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
