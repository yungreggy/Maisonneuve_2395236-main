<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 250);
            $table->string('adresse', 250);
            $table->string('telephone', 250);
            $table->string('email', 250);
            $table->date('date_naissance');
            $table->unsignedBigInteger('ville_id'); // Assure-toi que ce type correspond au type de la clé primaire de la table `villes`
            $table->foreign('ville_id')->references('id')->on('villes'); // Définit la clé étrangère
            $table->timestamps();
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
