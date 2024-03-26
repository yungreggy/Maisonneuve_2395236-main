<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Etudiant;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'etudiant_id',
        'langue',
        'fichier',
        'taille',
        'chemin'
    ];

    protected $table = 'documents'; // Assure-toi que c'est le nom correct de ta table

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }

    /**
     * Génère un nom de fichier unique pour le document.
     *
     * @return string
     */
    public static function genererNomFichier($titre, $etudiantId)
    {
        // Utilise Str::slug pour créer une version "nettoyée" du titre
        $base = Str::slug($titre, '_');

        // Ajoute un identifiant unique (timestamp + ID étudiant) pour garantir l'unicité
        $suffixe = time() . '_' . $etudiantId;

        return "{$base}_{$suffixe}";
    }


}

