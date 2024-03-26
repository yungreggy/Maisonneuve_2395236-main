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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->unsignedBigInteger('etudiant_id');
            $table->string('langue', 2)->nullable(); // Ajouté, nullable si la langue n'est pas toujours fournie
            $table->string('fichier'); // Chemin d'accès au fichier stocké
            $table->unsignedBigInteger('taille')->nullable(); // Ajouté, nullable si tu décides de ne pas stocker la taille
            $table->timestamps();
        
            $table->foreign('etudiant_id')->references('id')->on('etudiants')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
