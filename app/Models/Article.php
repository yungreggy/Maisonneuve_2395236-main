<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'contenu', 'date_publication', 'etudiant_id', 'langue'];

    // Ajouter date_publication aux propriétés de date pour qu'il soit automatiquement traité comme un objet Carbon
    protected $dates = ['date_publication'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
}
